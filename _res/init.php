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

	$apis = [
		"test" => function($pdata,&$res) {
			$res = [
				"success" => true,
				"message" => "test successful"
			];
		},
		"get_products" => function($pdata,&$res){
			include __DIR__."/controllers/productsController.php";

			productops::get_products($pdata,$res);
		},
		"add_product" => function($pdata,&$res){
			include __DIR__."/controllers/productsController.php";

			productops::add_products($pdata,$res);
		},
		"updatedb" => function($data,&$res){
			$msg = "working";
			$con = true;

			try{
				global $msg;

				include __DIR__.'/actions/check_db_connect.php';
			} catch(Exception $e){
				$msg = "Error -> $e";
				$con = false;
			} finally{
				$msg = $msg == "working" ? "database updated successfully" : $msg;
				$res = ["success" => $con,"message" => $msg];
			}
		}
	];

	$viewops = [
		"test" => function($pdata) {
			global $genui;

			$genui->gen_alert2('view test successful');
		},
		"overview" => function($pdata) {
			global $genui;

			$thepath = __DIR__."/ui_templates/inframe/dash_overview.php";

			$genui->gen_this($thepath);
		},
		"additem" => function($pdata){
			global $genui;

			$m_name = isset($pdata['model']) ? $pdata['model'] : null;

			if($m_name != null){
				$genui->gen_add_item($m_name);
			}
		}
	]
?>