<?php
	class genview{
		public static $scripts_created = 0;
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

		public function gen_dash_x(){
			include __DIR__."/../ui_templates/dashboard.php";
		}

		public function gen_login(){
			include __DIR__."/../ui_templates/login.php";
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
			writeme($this->showthis(__DIR__."/../ui_templates/inframe/fullpage_alt.php"));
		}

		public function gen_alert2($alert="",$heading="Alert!",$backlink="./"){
			$alert = $alert;
			$heading = $heading;
			$backlink = $backlink;

			include __DIR__."/../ui_templates/inframe/dash_alt.php";
			return;
		}

		public function gen_list($thelist,$mydata=null){
			include __DIR__.'/../ui_templates/fullpage_list.php';
		}

		public function gen_script($thedata){
			self::$scripts_created += 1;

			$cre8 = self::$scripts_created;
			$output = json_encode($thedata);

			include __DIR__.'/../_snippets/json_error_check.php';
			$iserr = json_we_good();
			say($iserr,"view_genview");

			if($iserr !== "none"){
				$output = $thedata;
			}

			echo <<<HTML
				<script>
					let prepro_{$cre8}_var = JSON.parse(`$output`);
				</script>
			HTML;
		}

		public function gen_sidebar(){
			include __DIR__.'/gen_sidebar.php';
		}

		public function gen_ai_styles(){
			// include __DIR__.'/../ui_templates/tmp_styles.php';
			echo <<<HTML
				<!--<script>alert(`fuck this`)</script>;-->
			HTML;
		}

		public function gen_this($loc){
			if(is_file($loc)){
				include "$loc";
			} else {
				$errtxt = "invalid file passed for generation";
				say($errtxt,"gen_view");
				$this->gen_alert2($errtxt);
			}
		}

		public function gen_add_item($model='admins'){
			include __DIR__.'/../ui_templates/inframe/additem.php';
		}
	}
?>