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
<html>
<head>
	<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	reducedHeader();
	?>
</head>

<body>

<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/loginutils/auth.php');
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

	$username = $_SESSION['username'];

	$newPass1 = $_POST['newPass1'];
	$user_to_change = $_POST['user_to_change'];
	if(strlen($newPass1) < 8){
		echo '<script> parent.errorAlert("Password is too short. Please make sure that the new password is at least 8 characters.","https://tdta.stthomas.edu/settings/admin/ChangePassword.php?user='.$user_to_change.'"); </script>';
	}else{
		$newPass1 = stripslashes($_POST['newPass1']);
		$newPass1 = mysqli_real_escape_string($con,$newPass1);

		$newPass2 = stripslashes($_POST['newPass2']);
		$newPass2 = mysqli_real_escape_string($con,$newPass2);

		$query1 = "SELECT * FROM `login` WHERE username LIKE '$user_to_change';";
		$result1 = mysqli_query($con,$query1);
			if (mysqli_num_rows($result1) == 1) {
				$row = mysqli_fetch_assoc($result1);
					if(strcmp($newPass1, $newPass2) == 0){
						$newPass2 = password_hash($newPass2, PASSWORD_DEFAULT);

						$query2 = "UPDATE `login` SET `password` = '$newPass2' WHERE `login`.`username` = '$user_to_change';";
						$result2 = mysqli_query($con,$query2);
						if(!$result2) {
							//Insert something that would happen if the information was not placed in
							//the database correctly.
							echo '<script> parent.errorAlert("'.mysqli_error($con).'","https://tdta.stthomas.edu/settings/admin/ChangePassword.php?user='.$user_to_change.'"); </script>';
						} else {
							echo '<script> parent.successAlert("Password has been changed.","https://tdta.stthomas.edu/settings/admin/UserRoster.php"); </script>';
						}
					}else { 
						echo '<script> parent.errorAlert("Your two new passwords do not match. Please try again.","https://tdta.stthomas.edu/settings/admin/ChangePassword.php?user='.$user_to_change.'"); </script>';}
			} else {
				echo '<script> parent.errorAlert("Username does not exist. Please try again.","https://tdta.stthomas.edu/settings/admin/ChangePassword.php?user='.$user_to_change.'"); </script>';}
	}
?>

</body>
</html>
