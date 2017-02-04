<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); ?>
<!--
<--- Nick Scheel and Chase Ingebritson 2016
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
	if(strlen($newPass1) < 8){
		echo '<script>parent.pwFailure("Your password must be at least 8 characters long.");</script>';
	}else{
		$newPass1 = stripslashes($_POST['newPass1']);
		$newPass1 = mysqli_real_escape_string($con,$newPass1);

		$newPass2 = stripslashes($_POST['newPass2']);
		$newPass2 = mysqli_real_escape_string($con,$newPass2);

		$currPass = stripslashes($_POST['currPass']);
		$currPass = mysqli_real_escape_string($con,$currPass);

		$query1 = "SELECT * FROM `login` WHERE username LIKE '$username';";
		$result1 = mysqli_query($con,$query1);
			if (mysqli_num_rows($result1) == 1) {
				$row = mysqli_fetch_assoc($result1);
					if (password_verify($currPass, $row['password'])) {
						if(strcmp($newPass1, $newPass2) == 0){
							$newPass2 = password_hash($newPass2, PASSWORD_DEFAULT);

							$query2 = "UPDATE `login` SET `password` = '$newPass2' WHERE `login`.`username` = '$username';";
							$result2 = mysqli_query($con,$query2);
							if(!$result2) {
								//Insert something that would happen if the information was not placed in
								//the database correctly.
								echo '<script>parent.errorAlert("'.mysqli_error($con).'","https://140.209.47.120/settings/user/PasswordUpdate.php");</script>';
							} else {echo '<script>parent.successAlert("Password successfully updated!","https://140.209.47.120/assistant.php");</script>';}
						}else { echo '<script>parent.errorAlert("Your two new passwords do not match.","https://140.209.47.120/settings/user/PasswordUpdate.php");</script>';}
					}else { echo '<script>parent.errorAlert("Your current password was entered incorrectly.","https://140.209.47.120/settings/user/PasswordUpdate.php");</script>';}
			} else {echo '<script>parent.errorAlert("You do not exist!","https://140.209.47.120/settings/user/PasswordUpdate.php");</script>';}
	}
?>

</body>
</html>
