function successAlert(text, dest) {
	swal({
		title: "Success!",
		text: text,
		type: "success",
		html: true
		},
		function() {
			window.location.href = dest;
		}
	);
}
function successAlert(text) {
	swal({
		title: "Success!",
		text: text,
		type: "success",
		html: true
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
			window.location.href = dest;
		}
	);
}
function errorAlert(text) {
	swal({
		title: "Oops!",
		text: text,
		type: "error",
		html: true
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
				window.location.href = dest;
		}
	);
}
function warningAlert (text) {
	swal({
		title: "Oops!",
		text: text,
		type: "warning",
		html: true
		}
	);
}
function infoAlert (text, dest) {
	swal({
		title: "Hey!",
		text: text,
		type: "info",
		html: true
		},
		function() {
				window.location.href = dest;
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
