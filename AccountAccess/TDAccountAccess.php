<?php
include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/AdminAuth.php");
include($_SERVER['DOCUMENT_ROOT'] . '/AccountAccess/permission_backend.php');

if(isset($_GET['user'])){
	$user = $_GET['user'];
}else{
	$user = "";
}
?>
<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title> TD Permissions Form </title>
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
	<script src="../third-party-packages/MaskedInput.js" type="text/javascript"></script>
	<script src="permission_scripts.js"></script>
	<style>
		.btn-custom {
			margin-top: 10px;
			margin-bottom: 5px;
		}
		.side-button {
			margin-top: 23px;
		}
		.bottom-button {
			margin-bottom: 40px;
		}
		.input-group {
			z-index: 0;
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
			<a class="btn btn-danger btn-block side-button" href="ViewPermissions.php"><span class="glyphicon glyphicon-arrow-left"></span> Return</a>
		</div>

		<div class="col-md-10 text-left">
			<div class="row">
				<div class="col-xs-6">
					<h1>Permissions Request Form</h1>
					<form id="accountForm" action="PermissionChangeOutput.php" class="input-append" method="POST">

						<!-- Begin Employee Information section -->
						<legend>Employee Information</legend>
						<!-- Removed for this iteration, left behind in case we need it again
						<div class="radio">
							<label><input type="radio" name="status" value="new" required> <b>New Employee</b> -
								Currently has no permissions</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="status" value="term" required> <b>Terminate Employee</b> -
								Remove all permissions</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="status" value="mod" required> <b>Existing
									Employee</b> - modify existing permissions</label>
						</div>
						-->
						<?php
							//The function below can be found in permission_backend.php
							//It populates in the form fields for name, username, ID, and phone number
							getUserInfo($user);
						?>

						<!-- End Employee Information section -->

						<!-- Begin Permissions section -->
						<legend style="margin-bottom: 10px;">Permissions</legend>
						<a href="EditPermissionOptions.php?usr=<?php echo $user; ?>">Can't find what you're looking for? Edit Permission Options.</a>
						<?php
							//The function below can be found in permission_backend.php
							//It populates in the checkbox fields for all permissions found in the db
							buildPerms($user);
							?>
						<!-- End Permissions section -->

						<!-- Begin Additional Permissions section -->
						<!-- Temorarily removed
						<legend>Additional Permissions</legend>
						<p>
							<i>
								Click "+" or press the Enter key for multiple additional permissions.<br>
								Permissions entered here will be added to the above list for all users.
							</i>
						</p>
						<div id="items">
						</div>
						<div class="input-group" style="margin-bottom: 5px;">
						<span class="input-group-btn">
							<button type="button" class="btn btn-success add"><span
										class="glyphicon glyphicon-plus"></span></button>
						</span>
							<input class="form-control addtl_perm new_perm" type="text" name="input[]">
						</div>
						<!-- End Additional Permissions section -->

						<!-- Begin Comments section -->
						<legend>Comments</legend>
						<div class="form-group">
							<textarea class="form-control" rows="7" id="comments"></textarea>
						</div>
						<!-- Begin Comments section -->

						<!-- Submit button and end of form -->
						<button type="submit" class="btn btn-custom">&nbsp;&nbsp;Submit Request&nbsp;&nbsp;&nbsp;</button><br>
						<a class="btn btn-danger bottom-button" href="ViewPermissions.php">Cancel and Return</a>
					</form>
					<!-- Helper form -->
					<form name="editOptions" method="POST" action="EditPermissionOptions.php" target="_self">
						<input type="hidden" name="current_user" value="<?php echo $user; ?>" />
					</form>

				</div>
			</div>

		</div> <!--End div for main section-->
		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>

	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
?>

</body>
</html>
