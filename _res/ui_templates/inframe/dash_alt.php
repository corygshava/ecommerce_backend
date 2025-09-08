<?php
	$alert = isset($alert) ? $alert : "alert information";
	$heading = isset($heading) ? $heading : "heading";

	echo <<<HTML
		<div class="spacy-md">
			<span class="h2">$heading</span>
			<hr>
			<span>$alert</span>
		</div>
	HTML;
?>
