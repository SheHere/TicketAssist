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
	<title>Change User Password</title>
	<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
</head>
<body>

<?php
	include $_SERVER["DOCUMENT_ROOT"] . '/includes/navbar.php';
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
		<!-- White space on left 1/12th of the page -->
		</div>
		<div class="col-md-10 text-left">
			<h1>Change User Password</h1>
			<p>This form will change the selected user's password.</p>
			<form id="passwordUpdateForm" action="pwdChange.php" method="post" target="passwordiFrame">
				<div class="form-group">
					<label for="user_to_change">Username:</label>
					<input type="text" class="form-control" name="user_to_change" value="<?php echo $_GET['user']; ?>">
				</div>
				<div class="form-group">
					<label for="newPass1">New Password:</label>
					<input type="password" class="form-control" name="newPass1">
				</div>
				<div class="form-group">
					<label for="newPass2">New Password:</label>
					<input type="password" class="form-control" name="newPass2">
				</div>
				<button type="submit" class="btn btn-custom">Submit</button>
			</form>
			<br>
			<iframe align="left" name="passwordiFrame" id="passwordiFrame" width="500" height="300" frameBorder="0" marginwidth="0"></iframe>


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
