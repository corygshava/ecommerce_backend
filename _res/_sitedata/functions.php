<?php
	require_once ".sitedata.php";

	// to be used for debug texts
	function say($what='nothing',$actor=''){
		global $hideechos;

		$echotext = $actor === '' ? "$what<br>" : "[$actor] -> $what<br>";

		if($hideechos === false){
			echo $echotext;
		}

		global $mekecholog;
		if($mekecholog){
			global $echolog;
			array_push($echolog,$echotext);
		}
	}

	// prefered for html
	function writeme($what='',$actor='',$mydata=null){
		$what = $what !== '' ? $what : announce();

		$echotext = $actor === '' ? "$what" : "[$actor] -> $what<br>";
		echo $echotext.".m";

		global $mekecholog;
		if($mekecholog){
			global $echolog;
			array_push($echolog,$echotext);
		}
	}

	function announce($value='testing'){
		return "<div class=\"said\">$value</div>";
	}
?>