<?php
    /**
     * Secure session-based authentication handler
     * Production-ready with security best practices
     */

    // Start session with secure settings
    session_start([
        'cookie_secure' => true,      // Only send over HTTPS
        'cookie_httponly' => true,    // Prevent JavaScript access
        'cookie_samesite' => 'Strict', // Prevent CSRF
        'use_strict_mode' => 1,       // Prevent session fixation
        'use_cookies' => 1,           // Use cookies only
        'cache_limiter' => 'nocache'  // Prevent caching
    ]);

    // >>> ---------------------------------------------------------------------------------------------- <<<

    // Regenerate session ID periodically for security
    if (!isset($_SESSION['created'])) {
        $_SESSION['created'] = time();
    } else if (time() - $_SESSION['created'] > 1800) { // Regenerate every 30 minutes
        session_regenerate_id(true);
        $_SESSION['created'] = time();
    }

    /**
     * Function to run when user is authenticated
     */
    function handleAuthenticatedUser() {
        // Example: Load user dashboard
        $userId = $_SESSION['user_id'] ?? null;
        $username = $_SESSION['username'] ?? 'User';
        
        // Log successful access
        error_log("Authenticated access: User ID {$userId}, Username {$username}");
        
        // Your authenticated logic here
        echo "<h1>Welcome, {$username}!</h1>";
        echo "<p>You are logged in successfully.</p>";
        echo "<a href='logout.php'>Logout</a>";
        
        // Additional authenticated functionality
        return true;
    }

    /**
     * Function to run when user is not authenticated
     */
    function handleGuestUser() {
        // Log unauthorized access attempt
        error_log("Unauthenticated access attempt from IP: " . $_SERVER['REMOTE_ADDR']);
        
        // Your guest logic here
        echo "<h1>Please Login</h1>";
        echo "<p>You need to log in to access this content.</p>";
        echo "<a href='login.php'>Login</a>";
        echo "<a href='register.php'>Register</a>";
        
        // Redirect option (uncomment if needed)
        // header('Location: login.php');
        // exit;
        
        return false;
    }

    /**
     * Function to run when session is invalid or compromised
     */
    function handleInvalidSession() {
        // Clear potentially compromised session
        session_unset();
        session_destroy();
        
        // Log security event
        error_log("Invalid session detected from IP: " . $_SERVER['REMOTE_ADDR']);
        
        // Your security response logic
        http_response_code(403);
        echo "<h1>Security Alert</h1>";
        echo "<p>Your session is invalid. Please log in again.</p>";
        echo "<a href='login.php'>Login</a>";
        
        return false;
    }

    /**
     * Main authentication check function
     * 
     * @return bool True if authenticated, false otherwise
     */
    function checkAuthentication() {
        // Validate session integrity
        if (!validateSession()) {
            return false;
        }
        
        // Check if user is logged in
        if (isset($_SESSION['logged_in']) && 
            $_SESSION['logged_in'] === true && 
            isset($_SESSION['user_id']) && 
            !empty($_SESSION['user_id'])) {
            
            // Verify session hasn't expired
            if (isset($_SESSION['last_activity']) && 
                (time() - $_SESSION['last_activity']) > 7200) { // 2 hours
                return false;
            }
            
            // Update last activity timestamp
            $_SESSION['last_activity'] = time();
            
            return true;
        }
        
        return false;
    }

    /**
     * Validate session for security
     * 
     * @return bool True if session is valid
     */
    function validateSession() {
        // Check for session hijacking indicators
        if (isset($_SESSION['user_agent']) && 
            $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
            return false;
        }
        
        if (isset($_SESSION['ip_address']) && 
            $_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR']) {
            // Allow for minor IP changes (e.g., mobile networks)
            $currentIp = $_SERVER['REMOTE_ADDR'];
            $storedIp = $_SESSION['ip_address'];
            
            // For production, you might want stricter checking
            if (strpos($currentIp, '192.168.') !== 0 && 
                strpos($storedIp, '192.168.') !== 0 &&
                $currentIp !== $storedIp) {
                return false;
            }
        }
        
        return true;
    }

    /**
     * Initialize session security markers
     */
    function initializeSessionSecurity() {
        if (!isset($_SESSION['user_agent'])) {
            $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
        }
        
        if (!isset($_SESSION['ip_address'])) {
            $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
        }
        
        if (!isset($_SESSION['last_activity'])) {
            $_SESSION['last_activity'] = time();
        }
    }

    // Main execution flow
    try {
        // Set appropriate headers
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: DENY');
        header('X-XSS-Protection: 1; mode=block');
        
        // Initialize security markers if not present
        initializeSessionSecurity();
        
        // Perform authentication check
        if (checkAuthentication()) {
            // User is authenticated
            handleAuthenticatedUser();
        } else {
            // User is not authenticated
            handleGuestUser();
        }
        
    } catch (Exception $e) {
        // Handle any unexpected errors securely
        error_log("Authentication check error: " . $e->getMessage());
        handleInvalidSession();
    }
?>