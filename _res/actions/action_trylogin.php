<?php
	require_once __DIR__.'/../controllers/useropsController.php';

	$uops = new userops();

	say(json_encode($_POST),"trylogin");
	say("trying login procedure","trylogin");

	global $genui;

	if(isset($_POST['username'],$_POST['password'])){
		$uname = $_POST['username'];
		$upass = $_POST['password'];

		say("attempting login","trylogin");
		$attemptres = $uops->checkUserDetails($uname,$upass);

		if(is_array($attemptres)){
			say("login successful","trylogin");
			$genui->gen_dash();
		} else {
			say("attempt result: $attemptres","trylogin");
			$genui->gen_login_x("$attemptres");
		}
	} else {
		say("[trylogin] -> pass the correct parameters first");
	}
?>