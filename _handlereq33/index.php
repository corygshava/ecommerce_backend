<?php

	if(isset($_GET['rt'])){
		require_once __DIR__.'/../_res/init.php';
		say('wait it works???');

		$outinfo = json_encode($_GET);
		say($outinfo);

		$genui->gen_alert($outinfo,"your output");
	} else {
		echo "yep waste of time";
	}
?>