let stylesmade = false;
let alertlogs = [];

function mekstyles() {
    let mystyles = `
    	/* Toast Container */
        #alertContainer {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            align-items: flex-end;
            z-index: 1000;
            pointer-events: none;
        }

        /* Toast */
        .alert {
            position: relative;
            padding: 1rem 1.5rem;
            border-radius: 12px;
            color: #fff;
            font-weight: 500;
            font-size: 0.95rem;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            opacity: 0;
            transform: translateY(20px);
            animation: toastSlideIn 0.4s ease forwards;
            pointer-events: none;
            transition: opacity 0.3s ease, transform 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: space-between;
            min-width: 260px;
            max-width: 360px;
        }

        /* Toast hover (slight lift) */
        .alert:hover {
            transform: translateY(-2px) scale(1.02);
            opacity: 0.95;
        }

        /* Variants */
        .alert.success { background: linear-gradient(135deg, #28a745, #218838); }
        .alert.info { background: linear-gradient(135deg, #17a2b8, #117a8b); }
        .alert.warning { background: linear-gradient(135deg, #ffc107, #e0a800); color: #222; }
        .alert.danger, .alert.error { background: linear-gradient(135deg, #dc3545, #b21f2d); }
        .alert.primary { background: linear-gradient(135deg, #007bff, #0056b3); }
        .alert.theme { background: linear-gradient(135deg, var(--themecolor), #333); }
        .alert.secondary { background: linear-gradient(135deg, #6c757d, #495057); }
        .alert.light { background: #fff; color: #333; border: 1px solid #ddd; }
        .alert.dark { background: linear-gradient(135deg, #343a40, #1d2124); }

        /* Strong text */
        .alert b, .alert strong {
            font-weight: 700;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.2em 0.6em;
            border-radius: 6px;
        }

        /* Slide in animation */
        @keyframes toastSlideIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

    `;

    let st = document.createElement('style');
    st.innerHTML = mystyles;
    document.body.appendChild(st);

    let thecon = document.createElement('div');
    thecon.id = 'alertContainer';
    document.body.appendChild(thecon);

    stylesmade = true;

    console.log("made styles");
}

function showAlert(alertMessage, alertTime, alertType) {
	alertMessage = alertMessage == undefined ? 'test message' : alertMessage;
	alertTime = alertTime == undefined ? 5 : alertTime;
	alertType = alertType == undefined ? "info" : alertType;

    if(!stylesmade){
        mekstyles();
    }

	// Create alert container if it doesn't exist
	let alertContainer = document.getElementById('alertContainer');

	// Create alert element
	const alertElement = document.createElement('div');
	alertElement.className = `alert ${alertType} alert-dismissible fade show`;
	alertElement.role = 'alert';
	alertElement.innerHTML = `
		${alertMessage}
		<button type="button" class="closebtn w3-right w3-hide" data-bs-dismiss="alert" aria-label="Close">
			<i class="fa fa-close"></i>
		</button>
	`;

	// Append alert to container
	alertContainer.appendChild(alertElement);

	// animate coming in
	let animoptions = {
		duration: 300,
		easing: 'ease-out',
		fill: 'forwards'
	};
	let leaveAnim = [
		{opacity: 1},
		{opacity: 0}
	];
	alertElement.animate([
		{opacity: 0,translate: '0 20px'},
		{opacity: 1,translate: '0 0'}
	],animoptions);

	alertElement.querySelector('button').addEventListener('click',() => {
		alertElement.animate(leaveAnim,animoptions);
		setTimeout(() => alertElement.remove(), animoptions.duration + 50);
	})

	if(alertTime.toString().toLowerCase() != "infinity"){
		setTimeout(() => {
			if(alertElement != null){
				alertElement.animate(leaveAnim,animoptions);
				setTimeout(() => alertElement.remove(), animoptions.duration + 50); // Allow fade-out effect
			}
		}, alertTime * 1000);
	}
	console.log(`i will die in ${alertTime} seconds`);

    let timestamp = (new Date()).getTime();

    alertlogs.push({msg: alertMessage,atype: alertType,atime: timestamp});
}

function alert_success(message,time) {showAlert(message,time,"success");}
function alert_info(message,time) {showAlert(message,time,"info");}
function alert_warning(message,time) {showAlert(message,time,"warning");}
function alert_danger(message,time) {showAlert(message,time,"danger");}
function alert_primary(message,time) {showAlert(message,time,"primary");}
function alert_secondary(message,time) {showAlert(message,time,"secondary");}
function alert_light(message,time) {showAlert(message,time,"light");}
function alert_dark(message,time) {showAlert(message,time,"dark");}

window.addEventListener('keydown',(e) => {
	if(e.key.toLowerCase() == 'tab'){
		let mystring = mekRandomString(16);
		showAlert(`random string : ${mystring}`,7,'warning');
	}
})