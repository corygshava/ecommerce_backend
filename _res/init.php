<?php
	global $genui;

	// loads utility classes necessary for use pretty much everywhere
	$pathprefix = __DIR__;

	// load the common functions and sitedata
	require_once $pathprefix.'/_sitedata/.sitedata.php';
	require_once $pathprefix.'/_sitedata/functions.php';
	require_once $pathprefix.'/models/_Qrun.class.php';

	require_once $pathprefix.'/controllers/sessionopsController.php';
	sessionops::init_sessions();

	require_once $pathprefix.'/_sitedata/.sessiondata.php';

	say('resources initialiser called','_res/init');

	// ui generator
	require_once $pathprefix.'/views/_gen_view.php';
	$genui = new genview();

	// the basecontroller class (if i create it)

	// list of action mappings
	$actions = [
		"trylogin" => function($passeddata){
			global $pathprefix;
			include $pathprefix.'/actions/action_trylogin.php';
		},
		"trylogout" => function($passeddata){
			global $pathprefix;
			include $pathprefix.'/actions/action_trylogout.php';
		},
		"showpayload" => function($what){
			global $genui;
			$genui->gen_alert($what,"your payload");
		},
		"showpd" => function($what){
			global $genui;
			$genui->gen_ai_styles();
			$genui->gen_alert($what);
		},
		"validate" => function($what){
			global $genui;
			$genui->gen_alert(json_encode($what),"data to validate");
		}
	];
?>