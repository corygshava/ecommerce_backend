let currentEditKey = null;

/* ---------- INI HANDLING ---------- */
async function loadIni(){
	const lang = document.getElementById('langSel').value;
	const res  = await fetch('getinis.php', {
		method:'POST',
		headers:{'Content-Type':'application/x-www-form-urlencoded'},
		body:   'lang='+encodeURIComponent(lang)
	});
	const data = await res.json();
	renderList(data);
}

function renderList(obj){
	const list = document.getElementById('iniList');
	list.innerHTML='';
	Object.entries(obj).forEach(([k,v])=>{
		const li = document.createElement('li');
		li.innerHTML=`
			<div>
				<span class="key">${k}</span>
				<span class="val">${v}</span>
			</div>
			<div>
				<button class="btn-outline" onclick="editItem('${k}','${v.replace(/'/g,"\\'")}')">Edit</button>
				<button class="btn-outline" onclick="deleteItem('${k}')">Delete</button>
			</div>`;
		list.appendChild(li);
	});
}

function editItem(k,v){
	currentEditKey = k;
	document.getElementById('fieldInput').value = k;
	document.getElementById('valueInput').value = v;
}

function clearForm(){
	currentEditKey=null;
	document.getElementById('fieldInput').value='';
	document.getElementById('valueInput').value='';
}

async function saveEntry(){
	const field = document.getElementById('fieldInput').value.trim();
	const value = document.getElementById('valueInput').value.trim();
	if(!field) return alert('Field required');
	const lang = document.getElementById('langSel').value;
	await fetch('saveini.php',{
		method:'POST',
		headers:{'Content-Type':'application/x-www-form-urlencoded'},
		body:`lang=${lang}&field=${encodeURIComponent(field)}&value=${encodeURIComponent(value)}&old=${encodeURIComponent(currentEditKey||'')}`
	});
	clearForm();
	loadIni();
}

async function deleteItem(key){
	if(!confirm('Delete '+key+'?')) return;
	const lang = document.getElementById('langSel').value;
	await fetch('deleteini.php',{
		method:'POST',
		headers:{'Content-Type':'application/x-www-form-urlencoded'},
		body:`lang=${lang}&field=${encodeURIComponent(key)}`
	});
	loadIni();
}

/* ---------- TRANSLATOR ---------- */
function openTranslator(){ document.getElementById('transModal').style.display='flex'; }
function closeTranslator(){ document.getElementById('transModal').style.display='none'; }

async function translate(){
	const word = document.getElementById('wordToTranslate').value.trim();
	const lang = document.getElementById('transLang').value;
	if(!word) return;
	const res = await fetch(
		`https://translate.googleapis.com/translate_a/single?client=gtx&sl=auto&tl=${lang}&dt=t&q=${encodeURIComponent(word)}`
	);
	const json = await res.json();
	document.getElementById('transResult').textContent = json[0][0][0];
}

/* ---------- INIT ---------- */
loadIni();