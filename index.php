<?php
	require_once '_res/init.php';
	include '_packages/loadpackages.php';

	// check login
	require_once '_res/actions/check_session.php';

	say($_SESSION['curstuff']);
	say();
	// writeme(json_encode($_SESSION));

	// echo json_encode($echolog);
?>