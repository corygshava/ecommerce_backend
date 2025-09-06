<?php
	require_once __DIR__.'/../_sitedata/.sitedata.php';
	require_once __DIR__.'/../init.php';

	// this sippet helps handle redirects
	function send_home(){
		global $homepage;
		global $baseloc;

		header("Location: {$baseloc}$homepage");
	}

	function send_here($where='./'){
		header("Location: $where");
	}

	function send_login(){
		global $baseloc;
		send_here("$baseloc/login");
	}

	function send_logout(){
		global $baseloc;
		send_here("$baseloc/logout");
	}
?>