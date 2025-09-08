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

	$fields = $instance::getinputFields();

	echo <<<HTML
		<div class="spacy-md">
			<span class="h2">Add $model record</span>
			<hr>
			<form class="formholder" id="theform">
				<!-- .inputholder>label[for="envalue"]{enter this}+input:text[name="envalue",id="envalue"] -->
	HTML;
	foreach($fields as $f){
		$fname = $f["name"];
		$ftype = $f["type"];
		$fcap = $f["caption"];
		$freq = $f["required"] ? " required" : "";

		if($ftype === "textarea"){
			echo <<<HTML
				<div class="inputholder">
					<label for="$fname">enter $fcap</label>
					<textarea class="myinput" type="$ftype" name="$fname" id="$fname" rows="3" placeholder="enter $fcap" $freq></textarea>
				</div>
			HTML;
		} else {
			echo <<<HTML
					<div class="inputholder">
						<label for="$fname">enter $fcap</label>
						<input class="myinput" type="$ftype" name="$fname" id="$fname" placeholder="enter $fcap here"$freq>
					</div>
			HTML;
		}
	}
	echo <<<HTML
				<div class="spacy-sm">
					<button class="btn multicolor"><i class="fa fa-plus"></i> Add item</button>
				</div>
			</form>
		</div>
	HTML;

	echo <<<HTML
		<script>
			let theform = undefined;

			window.addEventListener('load',() => {
				theform = document.querySelector('#theform');

				theform.addEventListener('submit',(e) => {
					e.preventDefault();
					submitData(e).then((m) => {
						setTimeout(() => {
							showresult(m);
							showform();
						},timing.duration + 200);
					});
				})
			})

			async function submitData(d) {
				console.log(d);

				hideform();

				let fdata = new FormData(theform);
				let data = Object.fromEntries(fdata.entries());

				data.operation = `$optype`;
				data.accesskey = `$apiaccesscode`;
				// console.log("fdata",fdata,"data",data);

				try{
					const rest = await fetch('_api/{$optype}_{$model}',{
						method: "POST",
						headers: {
							"Content-Type": "application/x-www-form-urlencoded"
						},
						body: JSON.stringify(data)
					});

					const result = await rest.text();

					console.log(result);

					return JSON.parse(result);
				} catch (err) {
					console.error(err);
					alert_danger(`error: \${err}`);

					return null;
				}
			}

			function hideform(){
				theform.animate([...fadeout],timing);
				theform.style.pointerEvents = "none";
			}

			function showform() {
				theform.animate([...fadeout].reverse(),timing);
				theform.removeAttribute('style');
			}

			function showresult(obj){
				if(obj == null){
					// showform();
					alert_danger("request incomplete");
				}

				if(obj.success){
					alert_success(obj.message);
				} else {
					alert_warning(obj.message);
				}
				console.log(obj);
			}
		</script>
	HTML;
	exit();
?>