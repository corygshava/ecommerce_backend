<?php
	require_once __DIR__.'/../controllers/useropsController.php';
	require_once __DIR__.'/../controllers/sessionopsController.php';

	$uops = new userops();
	$uops->checksession();

	$ison = sessionops::$sessionfound;

	if($ison == false){
		say("session not found","check_session");

		$genui->gen_login_x();
	} else {
		say("session found","check_session");

		$genui->gen_dash_x();
	}
?>