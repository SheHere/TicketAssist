<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php");
?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Delete User</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://140.209.47.120/styles/assistant.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
    <link rel="stylesheet" type="text/css" href="https://140.209.47.120/sweetalert-master/dist/sweetalert.css">
<script src="https://140.209.47.120/sweetalert-master/dist/sweetalert.min.js"></script>
<?php include ($_SERVER['DOCUMENT_ROOT'] . '/includes/alerts.php');?>

</head>
<body>

<!-- Creates the navbar, see file for details and modification -->
<?php
	include $_SERVER["DOCUMENT_ROOT"] . '/includes/navbar.php';
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
		<!-- White space on left 1/12th of the page -->
		</div>
		<div class="col-md-10 text-left">
			<h1>Delete User</h1>
			<p><strong>WARNING:</strong> this will delete all references to the inputed user. Please procede with caution.</p>
			<form id="userDeleteForm" action="deleteAll.php" method="post" target="iFrame">
				<div class="form-group">
					<label for="user_to_delete">Username of the account to be deleted:</label>
					<input type="text" class="form-control" name="user_to_delete">
				</div>
				<button type="submit" class="btn btn-danger">Submit</button>
			</form>
			<br>
			<iframe align="left" name="iFrame" id="iFrame" width="500" height="300" frameBorder="0" marginwidth="0" style="display: none;"></iframe>


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
