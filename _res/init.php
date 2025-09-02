	<?php
	// loads utility classes necessary for use pretty much everywhere
	$pathprefix = __DIR__;

	include $pathprefix.'/_snippets/sessionsOps.php';
	init_sessions();

	// load the common functions and sitedata
	require_once $pathprefix.'/_sitedata/.sitedata.php';
	require_once $pathprefix.'/_sitedata/functions.php';
	require_once $pathprefix.'/models/_Qrun.class.php';

	say('resources initialiser called','_res/init');

	// filegen
	require_once $pathprefix.'/views/_gen_view.php';
	$genui = new genview();

	// the basecontroller class (if i create it)

	// list of action mappings
	$actions = [
		"trylogin" => function($passeddata){
			global $pathprefix;
			include $pathprefix.'/actions/action_trylogin.php';
		},
		"showpayload" => function($what){
			global $genui;
			$genui->gen_alert($what,"your payload");
		},
		"validate" => function($what){
			global $genui;
			$genui->gen_alert(json_encode($what),"data to validate");
		}
	];
?>