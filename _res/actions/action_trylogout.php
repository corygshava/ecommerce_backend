<?php
	require_once __DIR__.'/../controllers/useropsController.php';
	require_once __DIR__.'/../_snippets/rdr.php';

	$uops = new userops();

	say(json_encode($_POST),"trylogout");
	say("trying logout procedure","trylogout");

	global $genui;
	global $sess_user_id;
	global $sess_username;


	if($uops->isloggedin()){
		say("session found, ending it","trylogout");
		$uops->logout();

		// Log successful logout
		$logline = "Logout successful: User ID {$userId}, Username {$username}";
		say($logline,"checksession");
		include __DIR__.'/../_sitedata/addlog.php';
	} else {
		say("no session found, redirecting","trylogout");
	}

	send_home();
	exit();
?>