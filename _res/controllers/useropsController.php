<?php
	require_once __DIR__.'/../models/admins.class.php';
	require_once __DIR__.'/../_snippets/sessionsOps.php';

	// handles all operations to do with user sessions
	class userops{
		public function logout(){
			session_start();
			session_unset();
			session_destroy();

			include __DIR__.'/../_snippets/rdr.php';

			send_home();
		}

		public function checksession(){
			include __DIR__.'/../_snippets/ai_checksession.php';
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

		public function startSession($value='')
		{
			// code...
		}
	}
?>