let sidebar = undefined;
let sidelinks = [];
let crumbs = undefined;

// dashboard functions
function init_sidebar() {
	sidebar = document.querySelector('[data-role="nav_sidebar"]');

	if(sidebar != undefined && sidebar != null){
		sidelinks = sidebar.querySelectorAll('a[data-role="sidebar-btn"]');

		init_sidelinks();
	} else {
		// alert_danger('sidebar not found');
	}
}

function init_sidelinks() {
	sidelinks.forEach((l,id) => {
		l.dataset.myindex = id;
		// l.innerText += '>> ilv dad';

		l.addEventListener('click',() => {
			sidelink(id,l.dataset.mylink);
		})
	})

	sidelinks[0].click();
}

function init_crumbs(path="dashboard") {
	if(crumbs == undefined){
		crumbs = document.querySelector('[data-role="breadcrumb"]');
	}

	if(crumbs != undefined){
		let outres = "<b>system_dash</b>";
		path.split("/").forEach(el => {outres += `/ <span class="node">${el}</span>`;})

		crumbs.innerHTML = outres;
	}
}

function sidelink(n,txt) {
	sidelinks.forEach(el => {el.classList.remove('active');});

	sidelinks[n].classList.add('active');
	getdata(txt);
	init_crumbs(txt);
}

// data getters
function getdata(where){
	alert_dark(`sending request to [api/${where}]`);

	theframe = document.querySelector('iframe');
	theframe.src = '_api/' + where;
}

// loader
window.addEventListener('load',() => {
	init_sidebar();
	init_crumbs();
})