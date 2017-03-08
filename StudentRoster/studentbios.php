<?php 
	include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php"); 
	include 'BuildBioPage.php';
?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Student Roster</title>
	<?php 
		include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
		fullHeader();
	?>
<link rel="stylesheet" href="https://140.209.47.120/styles/studentbios.css">
	<style>
		.badges {
			overflow: visible;
		}
	</style>

	<script>
	$(document).ready(function() {
			$('[data-toggle="tooltip"]').tooltip();
	});
	</script>
</head>
<body>

	<?php
		include ($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
	?>
	  
	<div class="container-fluid text-center">    
	  <div class="row content">
		<div class="col-md-1 col-sm-0">
		  <!--Left blank to provide 1/12th of the page blank on left side -->
		</div>
		<!--Begin main section, which will call the HTMl from the input file-->
		<div class="col-md-10 col-sm-12 text-left"> 
			<div class="container">
				<?php buildBioPage() ?>
			</div>  
		</div> <!--End div for main section-->
		
		<div class="col-md-1 col-sm-0 text-left"> 
			<!-- Left blank to provide 1/12th of the page blank on right side -->
		</div>	
		
	  </div> <!-- End div for Row Content -->
	</div><!--End div for Bootstrap container rules-->
	<?php
		include ($_SERVER['DOCUMENT_ROOT'] .  '/includes/footer.php');
	?>


</body>
</html>

