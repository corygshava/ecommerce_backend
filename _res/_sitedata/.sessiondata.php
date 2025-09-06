<?php
	global $sess_logged_in;
	global $sess_user_id;
	global $sess_username;

	$thepath = __DIR__;
	require_once $thepath.'/../controllers/sessionopsController.php';

	$curuserid = sessionops::get_s($sess_user_id) ?? "NA";
	// say("trying to find: [$sess_user_id] -> ".$_SESSION[$sess_user_id]." | $curuserid","sessiondata");
	$curusername = sessionops::get_s($sess_username) ?? "NA";
	// say("trying to find: [$sess_username] -> ".$_SESSION[$sess_username]." | $curusername","sessiondata");
	$curuserloggedin = sessionops::get_s($sess_logged_in) ?? "NA";
	// say("trying to find: [$sess_logged_in] -> ".$_SESSION[$sess_logged_in]." | $curuserloggedin","sessiondata");

	$s_userid = $curuserid;
	$s_username = $curusername;
	$s_loggedin = $curuserloggedin;
?>