function successAlert(text, dest) {
	swal({
		title: "Success!",
		text: text,
		type: "success",
		html: true
		},
		function() {
			if(dest !== undefined){
				window.location.href = dest;
			}
		}
	);
}
function errorAlert(text, dest) {
	swal({
		title: "Oops!",
		text: text,
		type: "error",
		html: true
		},
		function() {
			if(dest !== undefined){
				window.location.href = dest;
			}
		}
	);
}
function warningAlert (text, dest) {
	swal({
		title: "Oops!",
		text: text,
		type: "warning",
		html: true
		},
		function() {
			if(dest !== undefined){
				window.location.href = dest;
			}
		}
	);
}
function infoAlert (text) {
	swal({
		title: "Hey!",
		text: text,
		type: "info",
		html: true
		}
	);
}
function passwordAlert (text) {
	swal({
		title: "Hey!",
		text: text,
		type: "info",
		html: true,

		}
	);
}
