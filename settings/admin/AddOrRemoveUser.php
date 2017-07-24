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
	<title> Add or Remove User </title>
<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
?>
</head>
<body>

<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
		<!-- White space on left 1/12th of the page -->
		</div>

		<div class="col-md-10 text-left">
			<br>
			<div id="user_tabs">
				<ul class="nav nav-tabs">
					<li <?php if(strcmp('remove',$_GET['tab']) != 0){echo 'class="active"';} ?>><a data-toggle="tab" href="#new">New User</a></li>
					<li <?php if(strcmp('remove',$_GET['tab']) == 0){echo 'class="active"';} ?>><a data-toggle="tab" href="#remove">Remove User</a></li>
				</ul>

				<div class="tab-content">
					<div id="new" class="tab-pane fade <?php if(strcmp('remove',$_GET['tab']) != 0){echo 'in active';} ?>">
						<h1>Register New User</h1>
						<p>This form will allow you to give new users access to this site.</p>
						<p><i><span style="color: red;">*</span> denotes required field</i><p>
						<form id="newUserForm" action="newUser.php" method="post" target="newUserFrame" maxlength="20">
							<div class="form-group">
								<label for="fname">First Name:</label>
								<input type="text" class="form-control" name="fname">
							</div>
							<div class="form-group">
								<label for="lname">Last Name:</label>
								<input type="text" class="form-control" name="lname">
							</div>
							<div class="form-group">
								<label for="usernname"><span style="color: red;">*</span>Username:</label>
								<input type="text" class="form-control" name="username" required>
							</div>
							<div class="form-group">
								<label for="ust_id"><span style="color: red;">*</span>St. Thomas ID:</label>
								<input type="text" class="form-control" name="ust_id" required>
							</div>
							<div class="form-group">
								<label for="password1"><span style="color: red;">*</span>Password:</label>
								<input type="password" class="form-control" name="password1" required>
							</div>
							<div class="form-group">
								<label for="password2"><span style="color: red;">*</span>Repeat Password:</label>
								<input type="password" class="form-control" name="password2" required>
							</div>
							<div class="form-group">
								<label for="admin_status">Admin Status:</label>
								<select class="form-control" name="admin_status">
								<option value="1">Standard access</option>
								<option value="2">Super user</option>
								<option value="3">Admin</option>
								</select>
							</div>
							<div class="form-group">
								<label for="role"><span style="color: red;">*</span>Role:</label>
								<select class="form-control" name="role" required>
									<option value="">-----</option>
									<option value="0">Inactive</option>
									<option value="1">Student</option>
									<option value="2">Employee</option>
								</select>
							</div>
							<button type="submit" class="btn btn-custom">Submit</button>
						</form>
						<br>
						<iframe align="left" name="newUserFrame" width="100%" height="500" frameBorder="0" marginwidth="0" style="display: none;"></iframe>
					</div>
					<div id="remove" class="tab-pane fade<?php if(strcmp('remove',$_GET['tab']) == 0){echo 'in active';} ?>">
						<h1>Delete User</h1>
						<p><strong>WARNING:</strong> this will delete all references to the inputed user. Please procede with caution.</p>
						<form id="userDeleteForm" action="deleteAll.php" method="post" target="iFrame">
							<div class="form-group">
								<label for="user_to_delete">Username of the account to be deleted:</label>
								<input type="text" class="form-control" name="user_to_delete">
							</div>
							<div class="form-group">
								<label for="user_to_delete2">Confirm username to be deleted:</label>
								<input type="text" class="form-control" name="user_to_delete2">
							</div>
							<button type="submit" class="btn btn-danger">Submit</button>
						</form>
						<br>
						<iframe align="left" name="iFrame" id="iFrame" width="500" height="300" frameBorder="0" marginwidth="0" style="display: none;"></iframe>
					</div>
				</div>
			</div>



		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
	include '../includes/footer.php';
?>


</body>
</html>
