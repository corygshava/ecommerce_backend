<?php
	// classes

	// renders the form
	class render_form{
		public $title;
		public $msg;
		public $keyname;
		public $action;
		public $method;
		public $txt;
		public $npttype;

		function __construct($input){
			$this->title = isset($input["title"]) ? $input["title"] : "Enter something";
			$this->msg = isset($input["msg"]) ? $input["msg"] : "this is the message";
			$this->keyname = isset($input["keyname"]) ? $input["keyname"] : "input";
			$this->action = isset($input["action"]) ? $input["action"] : "./";
			$this->method = isset($input["method"]) ? $input["method"] : "get";
			$this->txt = isset($input["txt"]) ? $input["txt"] : "input goes here";
			$this->npttype  =isset($input["npttype"]) ? $input["npttype"] : "password";
		}

		public function renderit(){
			$title = $this->title;
			$msg = $this->msg;
			$keyname = $this->keyname;
			$action = $this->action;
			$method = $this->method;
			$txt = $this->txt;
			$npttype = $this->npttype;

			$res = include '../res/_templates/getcode.php';

			return $res;
		}
	}

	// holds operations
	function enter_info($data = null){
		// this basically spawns a login page
		if($data == null){
			return "pass info first";
		} else{
			$theform = new render_form($data);
			$finres = $theform->renderit();
			echo "$finres";
		}
	}
?>