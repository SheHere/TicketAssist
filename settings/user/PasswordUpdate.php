<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); ?>

<!--
<--- Nick Scheel and Chase Ingebritson 2016
<--- 
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Password Update</title>
	<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>

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
			<h1>Update Current Password</h1>
			<p>Please note that this password should be different from you St. Thomas password for security reasons.</p>
			<form id="passwordUpdateForm" action="updatePassword.php" method="post" target="passwordiFrame">
				<div class="form-group">
					<label for="curPass">Current Password:</label>
					<input type="password" class="form-control" name="currPass">
				</div>
				<div class="form-group">
					<label for="newPass1">New Password:</label>
					<input type="password" class="form-control" name="newPass1">
				</div>
				<div class="form-group">
					<label for="newPass2">New Password:</label>
					<input type="password" class="form-control" name="newPass2">
				</div>
				<button type="submit" class="btn btn-custom">Submit Password</button>
			</form>
			<br>
			<iframe align="left" name="passwordiFrame" id="passwordiFrame" width="500" height="300" frameBorder="0" marginwidth="0" target="_parent" style="display: block"></iframe>


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
