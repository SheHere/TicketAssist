<?php include $_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"; ?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Title </title>
	<?php 
		include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
		fullHeader();
	?>
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
		
			<h1>Testing!</h1>
			<p>This is a test page for developers.</p>
            <hr>
			<!-- Write test code below -->


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
