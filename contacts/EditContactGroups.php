<?php include $_SERVER['DOCUMENT_ROOT'] . "/loginutils/Auth.php"; ?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Contact Groups </title>
	<?php 
		include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
		fullHeader();
	?>
	<link rel="stylesheet" href="//140.209.47.120/third-party-packages/jquery-ui-1.12.1/jquery-ui.css">
	<script src="//140.209.47.120/third-party-packages/jquery-ui-1.12.1/jquery-ui.js"></script>
	<script>
		$( function() {
			$( "#sortable" ).sortable();
			$( "#sortable" ).disableSelection();
		} );
		
		function submitGroups() {
			var sortableStuff = $('#sortable');
			var orderData = $(sortableStuff).sortable('toArray');
			alert(orderData);
		}
	</script>
	<style>
		.well-sm {
			margin-bottom: 5px;
		}
		ul{
			list-style-type: none;
			list-style:none;
			padding-left:0;
		}
	</style>
</head>
<body>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>
  
<div class="container-fluid text-center">    
	<div class="row content">
		<div class="col-md-1 text-left"> 
		<!-- White space on left 1/12th of the page -->
		</div>
	 
		<div class="col-md-10 text-left"> 
			
			<h1>Edit Contact Groups</h1>
			<h4>Drag and drop into the order you would like them to appear!</h4>
			
			<div class="row">
				<div class="col-sm-6">
					<ul id="sortable" id="groupsList">
						<li class=" well well-sm ui-state-default" id="group_1"><h4><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 1</h4></li>
						<li class=" well well-sm ui-state-default" id="group_2"><h4><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 2</h4></li>
						<li class=" well well-sm ui-state-default" id="group_3"><h4><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>Item 3</h4></li>
					</ul>
					<button class="btn btn-custom" onclick="submitGroups();">asfdas</button>
				</div>
			</div>
			
		</div> <!--End div for main section-->
		  
		<div class="col-md-1 text-left"> 
			<!-- White space on right 1/12th of the page  -->
		</div>	
  	<br><br><br><br><br>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
?>


</body>
</html>
