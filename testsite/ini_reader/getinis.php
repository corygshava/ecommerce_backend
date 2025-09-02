<?php
	$lang = $_POST['lang'] ?? 'EN';
	$file = "../../lang/$lang/enGb.regent.ini";
	$data = file_exists($file) ? parse_ini_file($file) : [];
	header('Content-Type: application/json');
	echo json_encode($data);
?>