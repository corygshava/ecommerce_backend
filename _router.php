<?php
	function renderhead(){
		echo <<<HTML
			<base href="../"/>
		HTML;
		require_once '_assets/pieces/head_piece.php'; // init styles
	}
?>

<?php
	if(isset($_GET['rt'])){
		require_once __DIR__.'/_res/init.php';

		say("exec start: ".time(),"index");
		say("exec start: ".date('d/m/y h:i:s'),"index");

		$isapi = false;
		$isviewcall = false;

		if(isset($_GET['isapi'])){
			say("API call registered","_router");
			$isapi = true;
			// exit();
		}

		if(!$isapi){
			renderhead();
		}

		if(isset($_GET['viewcall'])){
			say("view call registered","_router");
			$isviewcall = true;
			// echo $_GET['rt'];
			// exit();
		}

		// figure which route to take
		$gl_thepath = $_GET['rt'];
		$extrareq = "";
		$gl_theroute = $gl_thepath;

		if(strpos($gl_thepath, "_") !== false && !$isapi){
			$dlist = explode("_", $gl_thepath);
			$gl_theroute = $dlist[0];
			$extrareq = $dlist[1];
		}

		say('wait it works???',"_router");

		$outinfo = json_encode($_GET,null,4);
		say($outinfo,"_router");

		try{
			global $isapi;
			global $isviewcall;

			$showcon = false;
			$pld = [];
			if(count($_POST) !== 0){
				$pld = array_merge($pld,$_POST);
			}
			if(count($_GET) !== 0){
				$pld = array_merge($pld,$_GET);
			}

			$data = file_get_contents('php://input');

			if($data !== ""){
				say($data,"_router");
				$tm_list = json_decode($data,true);
				say($tm_list,"_router");
				$dlist = $tm_list == null ? [] : $tm_list;
				$pld = array_merge($pld,$dlist);
				say(json_encode($pld),"_router");

				if (json_last_error() !== JSON_ERROR_NONE) {
				    throw new Exception("JSON decode error: ".json_last_error_msg(), 1);
				}
			}

			if($isapi){
				// exit();
				header("Content-Type = application/json");
			}

			// print_r($pld);
			$addme = ["pathdata" => $extrareq];
			$pld = array_merge($pld,$addme);

			if(isset($actions[$gl_theroute]) && !$isapi){
				say("route found","_router");

				$actions[$gl_theroute]($pld);
			} else {
				if($isapi && isset($apis[$gl_theroute])){
					say("apis route found","_router");
					$response = null;
					// $pld = count($_)

					try{
						global $response;

						$apis[$gl_theroute]($pld,$response);
					} catch(Exception $e){
						$response = [
							"success" => false,
							"message" => "$e"
						];
					} finally {
						echo json_encode($response);
					}
				} elseif($isviewcall && isset($viewops[$gl_theroute])) {
					say("viewops route found","_router");
					$viewops[$gl_theroute]($pld);
				} else {
					say("no route found","_router");
					if($isapi){
						$response = [
							"success" => false,
							"message" => "invalid request route"
						];

						echo json_encode($response);
					} else {
						$genui->gen_alert2("Invalid request","ERROR","javascript:history.back()");
					}
				}
			}
		} catch(Exception $e) {
			$showcon = true;
			say("error: $e","_router");
		}finally{
			// renders a page that shows all logs created, might mess up the page's design
			$showcon = false;
			// $genui->gen_list($echolog,['includeheader' => $showcon,'attribs' => 'data-shown=1']);
			// $genui->gen_script(json_encode($echolog));

			if(!$isapi){
				$out = json_encode(implode("_dvdr_", $echolog));

				echo <<<HTML
					<script>
						sessionStorage.setItem('lastlog',$out);
					</script>
				HTML;
			}

			say("exec end: ".time(),"index");
			say("exec end: ".date('d/m/y h:i:s'),"index");
		}
	} else {
		echo "yep, youre wasting your time";
	}
?>