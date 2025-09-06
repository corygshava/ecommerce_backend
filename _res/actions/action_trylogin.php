<?php
	require_once __DIR__.'/../controllers/useropsController.php';
	require_once __DIR__.'/../_snippets/rdr.php';

	$uops = new userops();

	say(json_encode($_POST),"trylogin");
	say("trying login procedure","trylogin");

	global $genui;
	global $sess_user_id;
	global $sess_username;

	if(isset($_POST['username'],$_POST['password'])){
		$uname = $_POST['username'];
		$upass = $_POST['password'];

		say("attempting login","trylogin");
		$attemptres = $uops->checkUserDetails($uname,$upass);

		if(is_array($attemptres)){
			say("login successful","trylogin");
			// $genui->gen_dash();
			$uid = $attemptres[0]['id'];

			say("user id logged in: $uid");
			$uops->startSession($uname,$uid);
			say("session set up userid: ".$_SESSION[$sess_user_id],"trylogin");
			say("session set up uname: ".$_SESSION[$sess_username],"trylogin");
			// exit();
			send_home();
		} else {
			say("attempt result: $attemptres","trylogin");
			$genui->gen_login_x("$attemptres");
		}
	} else {
		say("[trylogin] -> pass the correct parameters first");
	}
?>