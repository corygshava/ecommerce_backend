<?php
	/**
		* @author 		Cornelius Shava
		* @version 		1.0, 29/08/2025
		* @email 		corygshava777+coderdr@gmail.com
		* @copyright 	(c) 2025 Corygproductions
	*/

	// database connection data
	$dbuser = "root";
	$dbpass = "";
	$db = "t_ecommerce_dash";
	$host = "localhost";

	// made it into json for obvious reasons
	$dbobj = [
				"us" => "$dbuser",
				"pw" => "$dbpass",
				"db" => "$db",
				"hs" => "$host"
			];

	// site based variables
	$homepage = "/index";				// kinda obvious
	$baseloc = "/ecommerce_admin";		// made to make migration easier
	$hideechos = false;					// show echoes made by say()
	$hideechos = true;					// show echoes made by say()
	$mekecholog = true;					// keep a list of echoes called by say()
	$echolog = array();					// list of echoes

	// system code level variables
	$sys_tymformat = "Y-m-d H:i:s";
	$sys_sessionExpiry = 7200;			// 1 hour = 3600
	$sys_sessionLifetime = 1800;		// 10 minutes = 600

	// session variables
	$sess_lastact = 'last_activity';
	$sess_id_creationtym = "created";

	// user session parameters
	$sess_logged_in = "logged_in";
	$sess_user_id = "user_id";
	$sess_username = "username";

	// echo "<hr>sitedata called<hr>";
?>