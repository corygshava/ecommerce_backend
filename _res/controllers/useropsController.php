<?php
	require_once __DIR__.'/../models/admins.class.php';
	require_once __DIR__.'/sessionopsController.php';
	require_once __DIR__.'/../_sitedata/.sitedata.php';

	// handles all operations to do with user sessions
	class userops{
		public function logout(){
			sessionops::killsession();
		}

		public function checksession(){
			try {
				// Set appropriate headers
				header('X-Content-Type-Options: nosniff');
				header('X-Frame-Options: DENY');
				header('X-XSS-Protection: 1; mode=block');
				
				// Initialize security markers
				sessionops::initializeSessionSecurity();

				say("checking session","con_userops");
				$islogged = sessionops::checkAuthentication() ? "yes" : "no";
				say("checksession: $islogged","con_userops");

				if(sessionops::$forcelogout == true){
					say("logging out user","con_userops");
					$this->logout();
				}

				// exit();

				// Perform authentication check
				if ($islogged === false) {
					say("User session not found","con_userops");
					// User is not authenticated
					// handleGuest();
				} else {
					say("User session found","con_userops");
					// User is authenticated
					// handleUser();
				}
				
			} catch (Exception $e) {
				// Handle any unexpected errors securely
				error_log("Authentication check error: " . $e->getMessage());
				handleInvalidSession();
			} finally {
				return sessionops::$sessionfound;
			}
		}

		public function checkUserDetails($uname='ddd',$pass="nothing"){
			$md_pass = md5($pass);

			$myres = "processing...";

			$adm = new admins();

			$adm->getdata_con(["`username` = '$uname'"],"XAND");
			say(json_encode($adm->response),"trylogin");
			$lastresult = $adm->response;

			if(!$lastresult['success']){
				say(json_encode($lastresult['result']),"trylogin");
			} else {
				if(count($lastresult['result']) === 0){
					$myres = "username not found";
				} else {
					$adm->getdata_con(["`username` = '$uname'","`password` = '$md_pass'"],"XAND");
					$lastresult = $adm->response;
					if(count($lastresult['result']) === 0){
						$myres = "wrong password";
					} else {
						$myres = $lastresult['result'];
					}
				}
			}

			return $myres;
		}

		public function startSession($uname,$uid){
			global $sess_logged_in;
			global $sess_user_id;
			global $sess_username;

			$_SESSION[$sess_logged_in] = true;
			$_SESSION[$sess_user_id] = $uid;
			$_SESSION[$sess_username] = $uname;

			return true;
		}

		public function isloggedin(){
			global $sess_user_id;
			global $sess_username;

			return sessionops::check_session_data($sess_user_id) && sessionops::check_session_data($sess_username);
		}
	}
?>