<?php
	echo <<<HTML
		<base href="../"/>
	HTML;
	require_once '_assets/pieces/head_piece.php'; // init styles
?>

<?php
	if(isset($_GET['rt'])){
		require_once __DIR__.'/_res/init.php';

		$isapi = false;
		$isviewcall = false;

		if(isset($_GET['isapi'])){
			say("API call registered","dataops");
			// exit();
		}

		if(isset($_GET['viewcall'])){
			say("API call registered","dataops");
			// exit();
		}

		// figure which route to take
		$gl_thepath = $_GET['rt'];
		$extrareq = "";
		$gl_theroute = $gl_thepath;

		if(strpos($gl_thepath, "_") !== false){
			$dlist = explode("_", $gl_thepath);
			$gl_theroute = $dlist[0];
			$extrareq = $dlist[1];
		}

		say('wait it works???',"_dataops");

		$outinfo = json_encode($_GET,null,4);
		say($outinfo,"_dataops");

		try{
			$showcon = false;

			if(isset($actions[$gl_theroute])){
				say("route found","_dataops");
				$pld = count($_POST) !== 0 ? $_POST : (count($_GET) !== 0 ? $_GET : []);
				$addme = ["pathdata" => $extrareq];
				$pld = array_merge($pld,$addme);

				$actions[$gl_theroute]($pld);
			} else {
				say("no route found","_dataops");
				if($isapi){
					$response = [
						"success" => false,
						"message" => "invalid request route"
					];
				} else {
					$genui->gen_alert2("Invalid request","ERROR","javascript:hostory.back()");
				}
			}
		} catch(Exception $e) {
			$showcon = true;
			say("error: $e","_dataops");
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
		}
	} else {
		echo "yep waste of time";
	}
?>