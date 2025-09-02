<?php
	echo "<base href=\"../\"/>";

	if(isset($_GET['rt'])){
		// figure which route to take
		$gl_thepath = $_GET['rt'];
		$extrareq = "";
		$gl_theroute = $gl_thepath;

		if(strpos($gl_thepath, "_") !== false){
			$dlist = explode("_", $gl_thepath);
			$gl_theroute = $dlist[0];
			$extrareq = $dlist[1];
		}

		require_once __DIR__.'/_res/init.php';
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
			}
		} catch(Exception $e) {
			$showcon = true;
			say("error: $e","_dataops");
		}finally{
			// renders a page that shows all logs created, might mess up the page's design
			$genui->gen_list($echolog,['includeheader' => $showcon,'attribs' => 'data-shown=0']);
		}
	} else {
		echo "yep waste of time";
	}
?>