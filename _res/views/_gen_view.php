<?php
	class genview{
		// this class allows the system to read the contents of a file and echo it
		// just a lazy way to prevent the chaos of redirects

		public function readthis($thepath){
			$myres = 'no contents';

			if(is_file($thepath)){
				$myres = file_get_contents($thepath);
			}

			return $myres;
		}

		public function showthis($thepath){
			$myres = 'no contents';

			if(is_file($thepath)){
				include $thepath;
			}
		}

		// quick ui templates
		public function gen_dash(){
			include __DIR__."/../ui_templates/dashboard.php";
		}

		public function gen_login(){
			writeme($this->showthis(__DIR__."/../ui_templates/login.php"));
		}

		public function gen_login_x($passdata='none'){
			include __DIR__."/../ui_templates/login.php";
		}

		public function gen_alert($alert="",$heading="Alert!",$backlink="./"){
			$alert = $alert;
			$heading = $heading;
			$backlink = $backlink;

			include __DIR__."/../ui_templates/fullpage_alt.php";
			return;
			writeme($this->showthis(__DIR__."/../ui_templates/fullpage_alt.php"));
		}

		public function gen_list($thelist,$mydata=null){
			include __DIR__.'/../ui_templates/fullpage_list.php';
		}
	}
?>