<?php
	include '_checkaccess.php';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>module tester</title>
	<link rel="stylesheet" type="text/css" href="../res/_sharedassets/css/w3.css">
	<link rel="stylesheet" type="text/css" href="assets/main.css">
	<link rel="stylesheet" type="text/css" href="../res/_sharedassets/css/theme.css">

	<script src="assets/customalerter.js"></script>

	<style>
		.content{
			display: flex;
			justify-content: flex-start;
			align-items: center;
			flex-direction: column;
			padding: var(--size-sm);
			gap: var(--size-sm);
			min-height: 100vh;
		}
	</style>
</head>
<body>
	<div class="content">
		<div>
			<form action="#" method="post" id="queryform" class="card">
				<label for="themodule">which module are we testing</label>
				<input type="search" name="themodule" id="themodules">
			</form>
		</div>

		<div class="w3-container w3-card distance-md spacy-md testreport card">
			<i>test results appear here</i>
		</div>

		<div class="w3-hide w3-container w3-card distance-md spacy-md reqtests"></div>
	</div>

	<script>
		let theform = document.querySelector("#queryform");
		let outdisplay = document.querySelector(".testreport");

		theform.addEventListener('submit',(e) => {
			e.preventDefault();

			outdisplay.innerHTML = `<div class="centroid-col loadguy"><div class="loader"></div><p><i>getting information</i></p></div>`;

			// return;

			let response = undefined;
			let formdata = {"themodule" : theform.themodule.value};
			console.log(formdata);

			response = fetch('test_ops.php',{
				method: "POST",
				Headers: {'Content-Type':"application/json"},
				body: JSON.stringify(formdata)
			})
			.then(res => res.text())
			.then(data => {
				let thedata = JSON.parse(data);
				console.log(thedata);
				renderstats(thedata);
			})
		})

		function renderstats(m) {
			outdisplay.innerHTML = "";
			let output = document.createElement('div');

			output.className="output";

			if(!m.datapassed){
				output.innerHTML += "<i>no module name was passed</i>";
			} else {
				output.innerHTML = `<h2 class="w3-center">showing details for <b class="themetxt">${m.maname}</b></h2>`;

				Object.keys(m).forEach(el => {
					output.innerHTML += `<span>${el} : <b>${m[el]}</b></span>`;
				})

				let btns = document.createElement('div');
				btns.className = "btn-group";

				let make_btn = (cap,act) => {
					let btn = document.createElement('button');

					btn.className = "btn outline";
					btn.innerHTML = `${cap}`;

					btn.addEventListener('click',e => {
						act();
					})

					btns.appendChild(btn);
				}

				// change to false for true behaviour
				let override = true;

				if(m.hasmodel || override){make_btn("test model code",e => {checkaddr(m.model_path)});}
				if(m.hascontroller || override){make_btn("test controller code",e => {checkaddr(m.controller_path)});}

				if(m.hasmodel || m.hascontroller || override){
					output.innerHTML += "<hr><span><b>test for syntax errors</b></span><br>";
					output.appendChild(btns);
				}
			}

			outdisplay.appendChild(output);
		}

		async function checkaddr(where) {
			let reqres = undefined;
			let outdata = undefined;

			reqres = await fetch('get_mod.php',{
				method: "POST",
				Header: {'Content-Type' : "application/json"},
				body: JSON.stringify({'thepath' : where})
			})
			.then(res => res)
			.then(async data => {
				console.log(data);

				let fintext = await data;
				let restext = await data.text();
				let myres = typeof(restext) == "string" ? restext.toUpperCase().replaceAll("\\","/") : "...";
				let isokay = !(myres.includes("ERROR"));

				console.log(myres);

				if(data.status == 200 && isokay){
					alert_success(`[${data.status}] : ${data.statusText} <br> ${restext}`,4);
				} else if(isokay) {
					alert_warning(`[${data.status}] : ${data.statusText} <br> ${restext}`,12);
				} else {
					alert_danger(`[${data.status}] : ${data.statusText} <br> ${restext}`,12);
				}
			})
		}
	</script>
</body>
</html>>