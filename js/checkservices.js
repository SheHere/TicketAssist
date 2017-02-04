/*
	checkservices.js - Written by Nick Scheel - November 2016
	This code was taken directly from the source code of http://www.stthomas.edu/its/servicecatalog/
	It's purpose is to check if any St. Thomas services are down by looking at the twitter account 
	@ITSsrvstatus
	
*/

function updateServices() {
	var itsServices = ["Network","Email","Office365","Blackboard","Telephone","Murphy","Printing","Web", "Other"];
	var TwitterSearch= "https://blogs.stthomas.edu/wp-content/twitter.php?url=search&q=itssrvcstatus%20%23Other%20OR%20%23Printing%20OR%20%23Blackboard%20OR%20%23Network%20OR%20%23Web%20OR%20%23Murphy%20OR%20%23Phones%20OR%20%23Office365%20OR%20%23Email";
	
	jQuery.ajax({
	  url: TwitterSearch,
	  dataType: 'json',
	  success: function (data) {
	  var statuses = [];

//$.each(itsServices, function(i) {
//console.log("Services:"+itsServices[i]);

				$.each(data["statuses"], function (x) {					
					var messageDate = this["created_at"];
					messageDate=messageDate.substring(0,messageDate.indexOf("+"));
					var serviceMessage = '<span class="itservice-date">'+messageDate+'</span><br />' + this["text"];
					var serviceStatus = "";
					var currentService = "";
					var hashtags = this["entities"]["hashtags"];
					var currentHash;

					  $.each(hashtags, function () {
						  currentHash = this["text"];
						  if (itsServices.indexOf(currentHash)> -1) {
							currentService = currentHash;
							var index = itsServices.indexOf(currentService);
							if (index > -1) {
								itsServices.splice(index, 1);
							  //remove the service since we had a match
							}
						}

						  if (currentHash.toLowerCase() === "green" || currentHash.toLowerCase() === "red" || currentHash.toLowerCase() === "yellow" ) {
							  serviceStatus = this["text"].toLowerCase();
							 if((currentService!="") && (serviceStatus!="")){
							  $("#"+currentService).removeClass("green");
							  $("#"+currentService).addClass(serviceStatus);
							 }
						  }
					  });
							 if((currentService!="") && (serviceStatus!="")){
								$("#"+currentService+ " div.serviceMessage").html(serviceMessage);					
								$("#"+currentService+ " div.moreInfo").show();					
							 }

					});
			}
		});
		
};

updateServices();
setInterval(updateServices, 60000);
