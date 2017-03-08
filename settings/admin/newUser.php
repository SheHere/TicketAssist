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

	require($_SERVER['DOCUMENT_ROOT'] . "/loginutils/connectdb.php");

	$username = stripslashes($_POST['username']);

    //escapes special characters in a string
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_POST['password']);
	$password = mysqli_real_escape_string($con,$password);

	$admin_status = $_POST['admin_status'];

	$query = "INSERT into `login` (username, password, admin_status)
		VALUES ('$username', '" .password_hash($password, PASSWORD_DEFAULT)."', '$admin_status'); 

		INSERT INTO `users` (`username`, `fname`, `lname`, `bio`, `img_path`) VALUES ('$username', '', '', '', 'StudentRosterImages/PlaceholderImg.png');

		INSERT into `megalink` (username, link1, link2, link3, link4, link5)
		VALUES ('$username', 'https://whd.stthomas.edu', 'http://www.stthomas.edu/its/', 'https://www.random.org/passwords/', '', '');
		";
	$result = mysqli_multi_query($con,$query);
	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo '<script>parent.errorAlert("'.mysqli_error($con).'","https://140.209.47.120/settings/admin/register.php");</script>';
	} else {
		echo '<script> parent.successAlert("User successfully created.","https://140.209.47.120/settings/admin/register.php"); </script>';
	}
?>

</body>
</html>
