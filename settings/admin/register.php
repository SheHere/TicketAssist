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
  <title> Register New User </title>
	<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
	<style>
		iframe {
			display: none;
		}
	</style>
</head>
<body>

<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/includes/navbar.php");
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
		<!-- White space on left 1/12th of the page -->
		</div>

		<div class="col-md-10 text-left">

			<h1>Register New User</h1>
			<p>This form will allow you to give new users access to this site.</p>
			<p>This page should only be accessible by admin users.<p>
			<form id="newUserForm" action="newUser.php" method="post" target="newUserFrame" maxlength="20">
				<div class="form-group">
					<label for="usernname">Username:</label>
					<input type="text" class="form-control" name="username">
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" name="password">
				</div>
				<div class="form-group">
					<label for="admin_status">Admin Status:</label>
					<select class="form-control" name="admin_status">
					<option value="1">Standard access</option>
					<option value="2">Super user</option>
					<option value="3">Admin</option>
					</select>
				</div>
				<button type="submit" class="btn btn-custom">Submit</button>
			</form>
			<br>
			<iframe align="left" name="newUserFrame" width="100%" height="500" frameBorder="0" marginwidth="0"></iframe>

		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
?>


</body>
</html>
