<?php
	require_once __DIR__.'/../controllers/useropsController.php';

	$uops = new userops();

	$uops->checksession();
?>