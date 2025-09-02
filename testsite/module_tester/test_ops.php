<?php
	// functions and runtime data
	$modsfolder = "../../_res";
	$controller_path = "$modsfolder/controllers/";
	$model_path = "$modsfolder/models/";

	class testres{
		public $maname = "nada";
		public $datapassed = false;
		public $hascontroller = false;
		public $hasmodel = false;

		function __construct($d=false,$nme="dw"){
			$this->datapassed = $d;
			$this->maname = $nme;
		}
	}

	function gettestresults($mod='nada'){
		// global data made local
		global $controller_path;
		global $model_path;
		global $finobj;

		$finobj->maname = $mod;

		// data that will be fetched
		$datapassed = $mod != "nada";
		$isfound = false;

		$finres = "";
		$keepgoing = true;

		// check if data was passed
		$finobj->datapassed = $datapassed;
		if(!$datapassed){
			$keepgoing = false;
		}

		// validate progression
		if(!$keepgoing){
			return $finres;
		}

		// check if the controller exists
		$finobj->controller_path = $controller_path."{$mod}Controller.php";
		$isfound = is_file($finobj->controller_path);
		$finobj->hascontroller = $isfound;

		// check if the controller exists
		$finobj->model_path = $model_path."{$mod}.class.php";
		$isfound = is_file($finobj->model_path);
		$finobj->hasmodel = $isfound;

		$contxt = mybool($isfound);
		$finres .= "<p>$contxt</p>";

		// return the result no matter what
		$showthis = json_encode($finobj,JSON_PRETTY_PRINT,4);
		return $showthis;
	}

	function mybool($value=true){return ($value) ? "True" : "False";}
?>

<?php
	// actual API logic
	$theresult = "no module passed";
	$finobj = new testres(false,"none");

	$rawdata = file_get_contents("php://input");
	$data = json_decode($rawdata);

	if(json_last_error() !== JSON_ERROR_NONE){
		$data = null;
	}

	$themod = isset($_POST['themodule']) ? $_POST['themodule'] : ($data != null ? $data->themodule : "nada");

	// optimised for form submission
	if($themod != "nada"){
		$theresult = gettestresults($themod);
	} else {
		$theresult = json_encode($finobj);
	}
	

	echo "$theresult";
?>