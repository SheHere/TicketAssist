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
	$fname = addslashes($_POST['fname']);
	$lname = addslashes($_POST['lname']);
	$phonenum = $_POST['phonenum'];
	$bio = htmlentities($_POST['bio'], ENT_QUOTES, 'UTF-8');
	
	$query = "UPDATE `users` SET `fname` = '$fname', `lname` = '$lname', `bio` = '$bio', `phone_number` = '$phonenum' WHERE `users`.`username` = '$username';";
	$result = mysqli_query($con,$query);
	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo '<script>parent.errorAlert("'.mysqli_error($con).'","https://tdta.stthomas.edu/settings/user/UserSettings.php");</script>';
		echo mysqli_error($con);
	} else {echo '<script>parent.successAlert("Personal Information successfully updated!","https://tdta.stthomas.edu/settings/user/UserSettings.php");</script>';}
?>

</body>
</html>