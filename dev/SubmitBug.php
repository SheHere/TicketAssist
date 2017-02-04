<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); ?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Submit Feedback </title>
<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php'); 
	fullHeader();
?>
  
</head>
<body>

<?php
	include($_SERVER['DOCUMENT_ROOT'] .  '/includes/navbar.php');
?>
  
<div class="container-fluid text-center">    
	<div class="row content">
		<div class="col-md-1 text-left"> 
		<!-- White space on left 1/12th of the page -->
		</div>
	 
		<div class="col-md-10 text-left"> 
		
			<h1>Submit Feedback</h1>
			<form id="clientInfoForm" action="sendBug.php" method="post" target="iFrame">
			
				<div class="form-group">
						<label for ="url">URL:</label>
						<input type="url" class="form-control" name="url" autofocus>
				</div>
				
				<div class="form-group">
					<label for="note">Description</label>
					<textarea class="form-control" name="note" rows="10" placeholder="Specify what you were doing when the bug occured."></textarea>
				</div>
				
				<input type ="text" class="hidden" name="submittedBy" value="<?php echo $_SESSION['username']; ?>">
				<input id="submitbutton" type="submit" class="btn btn-custom" value="Submit Form">
				<br>
				<iframe name="iFrame" width="100%" height="335px" frameBorder="0" marginwidth="0px"></iframe>
			
		</div> <!--End div for main section-->
		  
		<div class="col-md-1 text-left"> 
			<!-- White space on right 1/12th of the page  -->
		</div>	
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
	include($_SERVER['DOCUMENT_ROOT'] .  '/includes/footer.php');
?>


</body>
</html>
