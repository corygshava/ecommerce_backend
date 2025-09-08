let sidebar = undefined;
let sidelinks = [];
let crumbs = undefined;
let theframe = undefined;

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
			sidelink(id);
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

function init_ui() {
	theframe = document.querySelector('iframe');

	if(theframe != undefined){
		theframe.addEventListener('load',() => {
			theframe.animate([...fadeout].reverse(),timing);
		})
	}
}

function hide_frame() {
	theframe.animate(hideme,{...timing, duration: 70});
}

function sidelink(n) {
	sidelinks.forEach(el => {el.classList.remove('active');});

	let el = sidelinks[n];
	let txt = el.dataset.mylink;
	let cap = el.dataset.mycaption;

	el.classList.add('active');

	getdata(txt);
	init_crumbs(cap);
}

// data getters
function getdata(where,ovr){
	let desti = where;
	alert_dark(`sending request to [${desti}]`);

	setTimeout(() => {
		hide_frame();
		theframe.src = desti;
	},100);
}

// loader
window.addEventListener('load',() => {
	init_sidebar();
	init_crumbs();
	init_ui();
})