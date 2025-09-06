<?php
	require_once __DIR__.'/../models/admins.class.php';
	require_once __DIR__.'/../_sitedata/.sitedata.php';

	class sessionops{
		public static $sessionfound = false;
		public static $forcelogout = false;
		public static $invalidsession = false;
		public static $sessionerror = "";

		public function __construct(){
			// Regenerate session ID after some time
			/*
			if (!isset($_SESSION[$sess_id_creationtym])) {
				$_SESSION[$sess_id_creationtym] = time();
			} else if (time() - $_SESSION[$sess_id_creationtym] > $sys_sessionLifetime) { // Regenerate every 30 minutes
				session_regenerate_id(true);
				$_SESSION[$sess_id_creationtym] = time();
				$logline = "session id regenerated";
				include __DIR__.'/../_sitedata/addlog.php';
			}*/
		}

		// >>> ---------------------------------------------------------------------------------------------- <<<
		/**
		 * Initialize session security markers
		 */

		public static function initializeSessionSecurity() {
			global $sess_lastact;

			if (!isset($_SESSION['user_agent'])) {
				$_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
			}
			
			if (!isset($_SESSION['ip_address'])) {
				$_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
			}
			
			if (!isset($_SESSION[$sess_lastact])) {
				$_SESSION[$sess_lastact] = time();
			}

			say("completed Security checkup","con_sessionops");
		}

		public static function handleUser() {
			global $sess_user_id;
			global $sess_username;

			$userId = $_SESSION[$sess_user_id] ?? null;
			$username = $_SESSION[$sess_username] ?? 'User';

			// Log successful access
			$logline = "Authentic access: User ID {$userId}, Username {$username}";
			say($logline,"con_sessionops");
			include __DIR__.'/../_sitedata/addlog.php';
			return true;
		}

		public static function handleGuest() {
			global $genui;

			// Log unauthorized access attempt
			$logline = "Unauthenticated access attempt from IP: " . $_SERVER['REMOTE_ADDR'];
			include __DIR__.'/../_sitedata/addlog.php';

			// show the login page
			$genui->gen_login();
		}

		/**
		 * Function to run when session is invalid or compromised
		 */
		public static function handleInvalidSession() {
			self::killsession();
			
			// Log security event
			$logline = "Invalid session detected from IP: " . $_SERVER['REMOTE_ADDR'];
			include __DIR__.'/../_sitedata/addlog.php';
			
			// security response
			http_response_code(403);
			$invalidsession = true;

			return false;
		}

		/**
		 * Main authentication check function
		 * 
		 * @return bool True if authenticated, false otherwise
		 */

		public static function checkAuthentication() {
			// Validate session integrity
			if (!self::validateSession()) {
				say("invalid session","con_sessionops");
				return false;
			}

			global $sys_sessionExpiry;
			global $sess_logged_in;
			global $sess_user_id;
			global $sess_lastact;

			// Check if user is logged in
			if (isset($_SESSION[$sess_logged_in]) && $_SESSION[$sess_logged_in] === true){
				say("user logged in","con_sessionops");

				if(isset($_SESSION[$sess_user_id]) && !empty($_SESSION[$sess_user_id])) {
					say("user id found","con_sessionops");

					if (isset($_SESSION[$sess_lastact]) && (time() - $_SESSION[$sess_lastact]) > $sys_sessionExpiry) {
						$oldtime = (int) $_SESSION[$sess_lastact];
						$newtime = time();
						$gap = $newtime - $oldtime;
						self::$sessionerror = "($gap | $sys_sessionExpiry) session expired, login again";
						self::$forcelogout = true;

						$sesserr = self::$sessionerror;
						say("err: $sesserr","con_sessionops");

						return false;
					}

					$_SESSION[$sess_lastact] = time();
					say("session started","con_sessionops");
					self::$sessionfound = true;
					return true;
				} else {
					self::$sessionerror = "no session id found";
				}
			} else {
				self::$sessionerror = "no log in session found";
			}
			
			return false;
		}

		/**
		 * Validate session for security
		 * 
		 * @return bool True if session is valid
		 */
		public static function validateSession() {
			say("validating session","con_sessionops");

			// Check for session hijacking indicators
			if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT']) {
				self::$sessionerror = "user agent mismatch error while validating session, please logout then try again";
				return false;
			}
			
			if (isset($_SESSION['ip_address']) && $_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR']) {
				// Allow for minor IP changes (e.g., mobile networks)
				$currentIp = $_SERVER['REMOTE_ADDR'];
				$storedIp = $_SESSION['ip_address'];

				self::$sessionerror = "address mismatch error while validating session, please logout then try again";
				return false;

				// For production, you might want stricter checking but for local this could be an issue
				if (strpos($currentIp, '192.168.') !== 0 && 
					strpos($storedIp, '192.168.') !== 0 &&
					$currentIp !== $storedIp) {
					return false;
				}
			}

			say("session validation successful","con_sessionops");
			return true;
		}

		public static function init_sessions(){
		    // Start session with secure settings
		    session_start([
		        'cookie_secure' => true,			// Only send over HTTPS
		        'cookie_httponly' => true,			// Prevent JavaScript access
		        'cookie_samesite' => 'Strict',		// Prevent CSRF
		        'use_strict_mode' => 1,				// Prevent session fixation
		        'use_cookies' => 1,					// Use cookies only
		        'cache_limiter' => 'nocache'		// Prevent caching
		    ]);

		    $_SESSION['curstuff'] = "all set at ".(date('d/m/y h:i:s'));
		}

		public static function set_session_data($key='',$value=''){
			if($key == ''){
				say("nothing passed","sessionops");
			} else {
				$_SESSION[$key] = $value;
			}
		}

		public static function get_session_data($key='',$defaultvalue=null){
			if(isset($_SESSION[$key])){
				return $_SESSION[$key];
			} else {
				return $defaultvalue;
			}
		}

		public static function check_session_data($key=''){
			return isset($_SESSION[$key]);
		}

		public static function killsession(){
			session_unset();
			session_destroy();
		}

		// shortened versions
		public static function get_s($k){
			return self::get_session_data($k);
		}

		public static function set_s($k='',$v=''){
			return self::set_session_data($k,$v);
		}

		public static function check_s($k){
			return self::check_session_data($k);
		}
	}
?>