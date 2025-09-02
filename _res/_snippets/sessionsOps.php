<?php
	function init_sessions(){
	    // Start session with secure settings
	    session_start([
	        'cookie_secure' => true,			// Only send over HTTPS
	        'cookie_httponly' => true,			// Prevent JavaScript access
	        'cookie_samesite' => 'Strict',		// Prevent CSRF
	        'use_strict_mode' => 1,				// Prevent session fixation
	        'use_cookies' => 1,					// Use cookies only
	        'cache_limiter' => 'nocache'		// Prevent caching
	    ]);

	    $_SESSION['curstuff'] = "im all set";
	}

	function set_session_data($key='',$value=''){
		if($key == ''){
			say("nothing passed","sessionops");
		}
	}
?>