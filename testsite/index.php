<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>MVC testsite</title>
	<link rel="stylesheet" type="text/css" href="res/_sharedassets/css/fa-all.css">
	<link rel="stylesheet" type="text/css" href="res/_sharedassets/css/theme.css">
	<link rel="stylesheet" type="text/css" href="res/_sharedassets/css/coryG_UIOps.css">
	<link rel="stylesheet" type="text/css" href="res/_sharedassets/css/coryG_UIOps.css">
	<link rel="stylesheet" type="text/css" href="res/_sharedassets/css/fonts.css">

	<script src="res/_sharedassets/js/SuperScript.js"></script>
	<script src="res/_sharedassets/js/toappend.js"></script>
	<script src="res/_sharedassets/js/customalerter.js"></script>
	<script src="res/_sharedassets/js/coryG_UIOps.js"></script>

	<style>
		.hero,
		.sections{
			display: flex;
			flex-direction: column;
			align-items: stretch;
			justify-content: center;
			text-align: center;
			width: min(800px, 96vw);
		}
	</style>
</head>
<body>
	<div class="content t1" id="app">
		<div class="hero w3-center">
			<span class="h2">Welcome to <b>MVC</b> testsite</span>
			<p>This is a simple area i made to host tools to speed up your development</p>
			<span class="h3 distance-md">Available tools</span>
		</div>

		<div class="sections gap-sm w3-center">
			<div>loading...</div>
		</div>
	</div>

	<div class="modal" id="previewmodal" data-shown="0" style="display: none;">
		<div class="modal-content">
			<h2 id="modalTitle"></h2>
			<p id="modalDesc"></p>
			<a id="modalLink" class="btn primary" target="_blank"></a>
			<div class="btn outline" data-toggler="#previewmodal">Close</div>
		</div>
	</div>

	<script>
		const app = document.getElementById("app");
		const modal = document.getElementById("modal");
		const modalTitle = document.getElementById("modalTitle");
		const modalDesc = document.getElementById("modalDesc");
		const modalLink = document.getElementById("modalLink");

		const defaultProjects = [
			{
				projectname: "screen preview",
				projectlink: "signal_receiver.html",
				projectdesc: "Preview lyrics and slides before projecting them."
			},
			{
				projectname: "remote",
				projectlink: "sender.html",
				projectdesc: "Control slides remotely from your phone or tablet."
			},
			{
				projectname: "settings",
				projectlink: "settings.html",
				projectdesc: "Customize your worship helper preferences."
			}
		];

		async function getProjects() {
			try {
				let res = await fetch("res/_api/getprojects.php");
				let rstxt = await res.text();

				console.log(rstxt);

				if (!res.ok) throw new Error("HTTP error");
				return JSON.parse(rstxt);
			} catch (err) {
				console.warn("API failed, using defaults ", err);
				return defaultProjects;
			}
		}

		function openModal(project) {
			modalTitle.innerHTML = project.projectname;
			modalDesc.innerHTML = project.projectdesc;
			modalLink.innerHTML = "Go to " + project.projectname;
			modalLink.href = project.projectlink;
			
			toggleShowB('#previewmodal',"flex","none");
		}

		function closeModal() {
			modal.classList.remove("active");
		}

		(async function init() {
			const projects = await getProjects();
			let sections = app.querySelector('.sections');

			sections.innerHTML = `
					${projects.map((p, i) => `
						<div class="sitelink card brighthover mbt" data-index="${i}">
							<b>${p.projectname}</b>
						</div>
					`).join("")}
			`;

			sections.querySelectorAll(".sitelink").forEach(el => {
				el.addEventListener("click", () => {
					const proj = projects[el.dataset.index];
					openModal(proj);
					alert_dark('previewing info');
				});
			});
		})();
	</script>
</body>
</html>
