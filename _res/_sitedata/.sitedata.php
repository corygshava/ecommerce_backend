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
	$homepage = "/index.php";			// kinda obvious
	$baseloc = "/ecommerce_admin";
	$hideechos = true;					// show echoes made by say()
	$mekecholog = true;					// keep a list of echoes called by say()
	$echolog = array();					// list of echoes

	// code level variables
	$tym_format = "Y-m-d H:i:s";

	// echo "<hr>sitedata called<hr>";
?>