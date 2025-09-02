<?php
	$dft = "index.php";
	$postmember = "thepath";
	$rqmethod = $_SERVER['REQUEST_METHOD'];

	// echo "$rqmethod<br>";

	$data = file_get_contents('php://input');
	$thedata = json_decode($data);

	if(json_last_error() !== JSON_ERROR_NONE){
		$thedata = null;
	}

	$thepath = isset($_POST[$postmember]) ? $_POST[$postmember] : ($thedata == null ? $dft : $thedata->$postmember);
	$isvalid = is_file($thepath);

	if($isvalid && !($thepath === $dft)){
		// prevents controllers from bugging out
		// uncomment once you've recreated the controller base
		// include '../../application\controller_base.class.php';
		include "$thepath";
	} else {
		if($rqmethod === "GET"){
			echo "<script>alert('invalid route')</script>";
		} else {
			echo `invalid route`;
		}
		// exit();

		http_response_code(404);
		echo "the file doesnt exist";
	}
?>