<?php
	$passdata = isset($passdata) ? $passdata : 'none';
	$model = isset($model) ? $model : "";

	$alert = isset($alert) ? $alert : "alert information";
	$heading = isset($heading) ? $heading : "heading";
	$optype = isset($optype) ? $optype : "add";

	$modelfile = __DIR__."/../../models/$model.class.php";

	global $genui;
	global $apiaccesscode;

	if(!file_exists($modelfile)){
		$genui->gen_alert2('the model doesnt seem to exist',"Record creation attempt error");
		exit();
	}

	if(!is_readable($modelfile)){
		$genui->gen_alert2('the model file is unreadable, check its permissions',"Record creation attempt error");
		exit();
	}

	require_once $modelfile;

	if(!class_exists($model)){
		$genui->gen_alert2('invalid class name, check the model code',"Record creation attempt error");
		exit();
	}

	$instance = new $model();
	$instance->getdata();

	$fields = $instance::getviewFields();

	// load navbar
	include __DIR__.'/topnav.php';
	view_nav($model);

	$thedata = $instance->response;
	$itwirked = $thedata['success'];
	$theres = $thedata['result'];

	say(json_encode($thedata),"viewdata");

	echo <<<HTML
		<!-- Recent $model Table -->
		<div class="spacy-md">
			<div class="table-card">
				<div class="table-header">
					<span class="table-title h3">$model Records</span>
					<hr>
					<select>
						<option selected disabled>--quick filters--</option>
						<option value="no_image">without images</option>
						<option value="low_stock">low stock</option>
						<option value="low_stock">with orders</option>
					</select>
				</div>
	HTML;

	if(!$itwirked){
		echo <<<HTML
				<div class="placeholder">
					<p>the request failed</p>
					<div>$theres</div>
				</div>
		HTML;
	} elseif(count($theres) == 0) {
		echo <<<HTML
				<div class="placeholder">
					<p>no records yet</p>
				</div>
		HTML;
	} else {
		$cols = $fields;

		require_once __DIR__.'/special_case_tables.php';
		$isspecial = isset($specialcases[$model]);

		echo <<<HTML
				<table>
					<thead>
						<tr>
		HTML;


		if($isspecial && isset($specialcases["{$model}_headings"])){
			$specialcases["{$model}_headings"]($cols);
		} else {
			foreach ($fields as $f) {
				say(json_encode($f));
				$cap = $f['caption'];
				echo "<th>$cap</th>\n";
			}
		}

		echo <<<HTML
						</tr>
					</thead>
					<tbody>
		HTML;

		if($isspecial){
			foreach($theres as $row){
				$specialcases[$model]($row,$fields);
			}
		} else {
			foreach($theres as $row){
				echo <<<HTML
						<tr>
				HTML;
				foreach ($fields as $f) {
					say("f: ".json_encode($f),"viewdata");
					$dta = $f['name'];
					$val = $row[$dta];

					$typ = $f['type'];
					$showme = $val;

					if(strtolower($typ) == "number"){
						$showme = number_format($val,0,'.',',');
					}

					echo "<td> $showme</td>\n";
				}
				echo <<<HTML
						</tr>
				HTML;
			}
		}

		echo <<<HTML
					</tbody>
				</table>
		HTML;
	}

	echo <<<HTML
			</div>
		</div>
	HTML;
?>