<?php include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php"); ?>
<!DOCTYPE html>


<!--
<--- Services.php - Written by Nick Scheel - November 2016
<--- Displays serice status as seen at the link here: http://www.stthomas.edu/its/servicecatalog/
<--- Code was stripped directly from the page source found at the link above.
<---
--->

<html lang="en">
<head>
	<title>Services</title>

	<link rel="stylesheet" href="styles/services.css">
	<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
	<!-- Sets the default column height to 100% -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
	<base target="_blank" />
</head>
<body>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<br><span style="color: #1a7934 !important;"><strong>Green</strong></span> = no issue, <span style="color: #f1c40f;"><strong>Yellow</strong></span> =  minor issue , <span style="color: #cc2329;"><strong>Red</strong></span> = major issue.</p><div class="clearfix left-content-item main-body-titleless"></div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div id="Network" class="itsservice green">
				<div id="networkServiceStatus" class="itservice-box">
				  <h3>Network</h3>
				</div>
				<div class="serviceMessage"></div>
				<div class="moreInfo">
					<a data-category="Button" data-action="Service Status Dashboard" data-label="Network" href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Network&src=typd" class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a> 
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div id="Email" class="itsservice green">
				<div id="email365ServiceStatus" class="itservice-box">
				  <h3>Email</h3>
				</div>
				<div class="serviceMessage"></div>
				<div class="moreInfo">
					<a data-category="Button" data-action="Service Status Dashboard" data-label="Email" href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Email&src=typd" class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a> 
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div id="Blackboard" class="itsservice green">
				<div id="blackboardServiceStatus" class="itservice-box">
					<h3>Blackboard</h3>
				</div>
				<div id="blackboardServiceMessage" class="serviceMessage"></div>
				<div class="moreInfo">
					<a data-category="Button" data-action="Service Status Dashboard" data-label="Blackboard" href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Blackboard&src=typd" class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a> 
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div id="Murphy" class="itsservice green">
				<div id="murphyServiceStatus" class="itservice-box">
					<h3>Murphy</h3>
				</div>
				<div id="murphyServiceMessage" class="serviceMessage"></div>
				<div class="moreInfo">
					<a data-category="Button" data-action="Service Status Dashboard" data-label="Murphy" href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Murphy&src=typd" class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a> 
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div id="Telephone" class="itsservice green">
				<div id="telephoneServiceStatus" class="itservice-box">
					<h3>Phones</h3>
				</div>
				<div id="telephoneServiceMessage" class="serviceMessage"></div>
				<div class="moreInfo">
					<a data-category="Button" data-action="Service Status Dashboard" data-label="Telephone" href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Telephone&src=typd" class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a> 
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div id="Printing" class="itsservice green">
				<div id="printingServiceStatus" class="itservice-box">
					<h3>Printing</h3>
				</div>
				<div id="printingServiceMessage" class="serviceMessage"></div>
				<div class="moreInfo">
					<a data-category="Button" data-action="Service Status Dashboard" data-label="Printing" href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Printing&src=typd" class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a> 
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4">
			<div id="Web" class="itsservice green">
				<div id="webServiceStatus" class="itservice-box">
					<h3>Web</h3>
				</div>
				<div id="webServiceMessage" class="serviceMessage"></div>
				<div class="moreInfo">
					<a data-category="Button" data-action="Service Status Dashboard" data-label="Web" href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Web&src=typd" class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div id="Office365" class="itsservice green">
				<div id="office365ServiceStatus" class="itservice-box">
					<h3>Office 365</h3>
				</div>
				<div class="serviceMessage"></div>
				<div class="moreInfo">
					<a data-category="Button" data-action="Service Status Dashboard" data-label="Office 365" href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Office365&src=typd" class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a> 
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div id="Other" class="itsservice green">
				<div id="otherServiceStatus" class="itservice-box">
					<h3>Other</h3>
				</div>
				<div id="otherServiceMessage" class="serviceMessage"></div>
				<div class="moreInfo">
					<a data-category="Button" data-action="Service Status Dashboard" data-label="Other" href="https://twitter.com/search?f=tweets&q=%40ITSsrvcstatus%20AND%20%23Other&src=typd" class="learn-more-font">More Info <i class="fa fa-chevron-right"></i></a>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Call script to check if services are down or not -->
<script src="js/checkservices.js"></script>
<script>
	if(($"div").hasClass("yellow") || ($"div").hasClass("red")){
		window.parent.document.getElementById('alert').style.display = "block";
	}
	
</script>


</body>
</html>





