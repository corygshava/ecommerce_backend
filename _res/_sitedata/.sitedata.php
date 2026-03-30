<?php
	/**
		* @author 		Cornelius Shava
		* @version 		1.0, 29/08/2025
		* @email 		corygshava777+coderdr@gmail.com
		* @copyright 	(c) 2025 Corygproductions
	*/

	// load external scripts (just to be safe)
	require_once __DIR__.'/functions.php';
	require_once __DIR__.'/../../_packages/loadpackages.php';

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
	// $hideechos = true;					// comment this line to always show echos
	$mekecholog = true;					// keep a list of echoes called by say()
	$echolog = array();					// list of echoes

	// system code level variables
	$sys_tymformat = "Y-m-d H:i:s";
	$sys_sessionExpiry = 7200;			// 1 hour = 3600
	$sys_sessionLifetime = 1800;		// 10 minutes = 600

	// session variables
	$sess_lastact = 'last_activity';
	$sess_id_creationtym = "created";

	// echo "<hr>sitedata called<hr>";

	// security setup
	load_package('super_encryptor');
	$encryptor = new super_encryptor();

	$encdata = [
		"offset" => 16,
		"salt" => 'Ixwj',
		"chunks" => 13
	];

	$true = 'JHKu';
	$false = 'vaBIu';

	// security info
	$ini_content = file_get_contents(__DIR__.'/.sitedata.ini');
	$d_txt = $encryptor->decryptme($ini_content,$encdata['offset'],$encdata['salt']);
	$sd_ = parse_ini_string($d_txt);

	$apiaccesscode = $sd_['api_access_code'];
	$hideechos = $sd_['hide_echoes'] == "true";
	$echoesout = $hideechos ? "yes, dont show echoes" : "no, show echoes";

	// user session parameters
	$sess_logged_in = $sd_['sess_logged_in'];
	$sess_user_id = $sd_['sess_user_id'];
	$sess_username = $sd_['sess_username'];
	$sess_serial = $sd_['sess_serial'];

	// $hideechos = true;
	// $hideechos = false;

	// for debug purposes
	/*
		file_put_contents(__DIR__.'/.sitedata.ok.ini', $d_txt);
		echo '<hr>';
			print_r($sd_);
		echo "e: $echoesout<br><hr>";
	*/

	// true -> JHKu
	// false -> vaBIu
	// print_r($securedata);
	// exit();
?>