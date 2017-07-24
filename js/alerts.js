/*
 * Set of SweetAlert functions, see https://tdta.stthomas.edu/sweetalert-master/
 * for more details.
 * Each is given text and destination (dest). Text is what will be displayed
 * in the alert popup, and dest is a URL that the user will be redirected
 * to after clicking OK
*/
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
		html: true

		}
	);
}
// text and dest are as above, formhandler is a .php
// file that will handle the deletion, id is the unique
// identifier for what is being deleted
function confirmDelete (dest, formhandler, delete_id){
    swal({
		title: "Are you sure?",
		text: "You will not be able to recover it!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Yes, delete it!",
		closeOnConfirm: false
        },
        function(){
            //create XMLHttpRequest Object in modern browsers, or ActiveXObject in IE5 and IE6
    		var xhttp;
            if (window.XMLHttpRequest) {
                xhttp = new XMLHttpRequest();
            } else {
                // code for IE6, IE5
                xhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            //Create event for when a response is received
			xhttp.onreadystatechange = function() {
            	if (this.readyState == 4 && this.status == 200) {
            		if(this.responseText == 1){
                        swal({
                                title: "Success!",
                                text: "Item successfully deleted.",
                                type: "success",
                                html: true
                            },
                            function() {
                                if(dest !== undefined){
                                    window.location.href = dest;
                                }
                            });
					}else{
                        swal({
                                title: "Oops!",
                                text: this.responseText,
                                type: "error",
                                html: true
                            },
                            function() {
                                if(dest !== undefined){
                                    window.location.href = dest;
                                }
                            });
					}
				}
			};
            //Create request and send it
			xhttp.open("GET", formhandler+"?id="+delete_id, true);
			xhttp.send();
        });
}