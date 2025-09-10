<?php
	function add_nav($mdl){
		echo <<<HTML
			<div class="innav flowline spread">
				<div>
					<a class="page-btn" href="_view/viewdata?model=$mdl"><i class="fa fa-chevron-left"></i> back</a>
				</div>
				<div>
					<a class="page-btn" onclick="window.location.reload()"><i class="fas fa-refresh"></i> reload page</a>
				</div>
			</div>
		HTML;
	}

	function view_nav($mdl){
		echo <<<HTML
			<div class="innav flowline spread">
				<div>
					<a class="page-btn" href="_view/additem?model=$mdl"><i class="fa fa-plus"></i> add new record</a>
				</div>
				<div>
					<a class="page-btn" onclick="window.location.reload()"><i class="fas fa-refresh"></i> reload page</a>
				</div>
			</div>
		HTML;
	}
?>