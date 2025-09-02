<?php
	$msg = isset($msg) ? $msg : "this is the message";
	$keyname = isset($keyname) ? $keyname : "input";
	$action = isset($action) ? $action : "./";
	$method = isset($method) ? $method : "get";
	$txt = isset($txt) ? $txt : "input goes here";
	$npttype = isset($npttype) ? $npttype : "password";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Simple Centered Form</title>

	<link rel="stylesheet" type="text/css" href="../../assets/css/w3.css">
	<!-- <link rel="stylesheet" type="text/css" href="assets/coryg_base.css"> -->
	<link rel="stylesheet" type="text/css" href="assets/main.css">
	<link rel="stylesheet" type="text/css" href="../res/_sharedassets/css/theme.css">

	<style>
		/* Form card styling */
		.form-card {
			/*background: #fff;*/
			padding: 2rem 2.5rem;
			border-radius: 8px;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
			text-align: center;
			width: min(400px,96vw);
			/*max-width: 320px;*/
		}

		.subtitle {
			margin: 0 0 1.5rem;
			font-size: 0.9rem;
			color: #666;
		}

		input[type="password"] {
			width: 100%;
			padding: 0.6rem;
			margin-bottom: 1rem;
			border: 1px solid #ccc;
			border-radius: var(--roundness);
			box-sizing: border-box;
		}
	</style>

	<script>
		alert(`<?=htmlspecialchars($msg)?>`);
	</script>
</head>
<body class="centroid">
	<div class="form-card card">
		<h1>Admin Access</h1>
		<p class="subtitle"><b><?=$msg?></b></p>
		<form method="<?=$method?>" action="<?=$action?>" class="flow full">
			<input type="<?=$npttype?>" name="<?=$keyname?>" placeholder="<?=$txt?>" required>
			<button class="btn primary" type="submit">Submit Key</button>
		</form>
	</div>

	<div class="w3-hide">
		<!-- coz theres a number 1 that just spawns randomly -->
</body>
</html>