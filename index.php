<?php
	require_once '_assets/pieces/head_piece.php'; // init styles
?>

<?php
	try{
		require_once '_res/init.php';

		require_once '_packages/loadpackages.php';
		say("exec start: ".time(),"index");
		say("exec start: ".date('d/m/y h:i:s'),"index");

		// check login
		require_once '_res/actions/check_session.php';

		say($_SESSION['curstuff'],"index"); // test session display, set to show 'im all set [current time]'
		say("exec end: ".time(),"index");
	} finally {
		$genui->gen_script($echolog);
	}
?>