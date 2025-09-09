<?php
	$specialcases = [];

	// format = generate headings, then generate rows
	$specialcases['products_headings'] = function($flds = []){
		foreach ($flds as $f) {
			// say(json_encode($f));
			$cap = $f['caption'];
			echo "<th>$cap</th>\n";
		}

		echo "<th>actions</th>";
	};
	$specialcases['products'] = function($row,$flds){
		echo <<<HTML
				<tr>
		HTML;

		foreach ($flds as $f) {
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
					<td>
						<div class="flowline left themeround">
							<button class="w3-btn w3-black editbtn themehover" data-tooltip="edit" data-role="edit_record"><i class="fa fa-pencil-alt"></i></button>
							<button class="w3-btn w3-black editbtn themehover" data-tooltip="delete" data-role="delete_record"><i class="fa fa-trash"></i></button>
							<button class="w3-btn w3-black editbtn themehover" data-tooltip="view" data-role="view_record"><i class="fa fa-eye"></i></button>
						</div>
					</td>
				</tr>
		HTML;
	}
?>