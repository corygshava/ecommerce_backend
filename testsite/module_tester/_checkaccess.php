<?php
	include '../res/_controllers/functions.controller.php';

	$wantedkey = file_get_contents("jkeslnewniauwnfwekjnfaewlknfiwenfewf_verifiedtoken.txt");
	$keepon = False;
	$the_default = "no_key_passed";
	$thekey = isset($_GET['isadmin']) ? $_GET['isadmin'] : (isset($_POST['isadmin']) ? $_POST['isadmin'] : $the_default);

	if($thekey === $wantedkey){
		// echo "$thekey ----> $wantedkey = warked";
		$keepon = true;
	} else {
		// echo "$thekey ----> $wantedkey = notwarked<br>";

		$mydata = [
			"title"=>"Verify Access",
			"msg" => "enter access key",
			"keyname" => "isadmin",
			"method"=>"post",
			"txt"=>"enter your key here..."
		];

		if($thekey == ""){
			enter_info($mydata);
		} elseif($thekey == $the_default){
			$mydata["msg"] = "pass a key to gain access";
			enter_info($mydata);
		}elseif($thekey != "corygshava"){
			$mydata["msg"] = "invalid access key";
			enter_info($mydata);
		} else {
			echo "WTF did you just do!!!!";
		}
	}

	if(!$keepon){
		exit();
	}
?>