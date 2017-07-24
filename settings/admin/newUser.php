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
// removes backslashes
$username = stripslashes($_REQUEST['username']);
$fname = stripslashes($_REQUEST['fname']);
$lname = stripslashes($_REQUEST['lname']);

//escapes special characters in a string
$username = mysqli_real_escape_string($con, $username);
$ust_id = mysqli_real_escape_string($con, $ust_id);
$password1 = stripslashes($_REQUEST['password1']);
$password1 = mysqli_real_escape_string($con, $password1);
$password2 = stripslashes($_REQUEST['password2']);
$password2 = mysqli_real_escape_string($con, $password2);
$admin_status = $_POST['admin_status'];
$role = $_POST['role'];

if (strcmp($password1, $password2) == 0) {
	$query = "INSERT into `login` (username, password, admin_status, role)
			VALUES ('$username', '" . password_hash($password2, PASSWORD_DEFAULT) . "', $admin_status, $role);";
	$result = mysqli_query($con, $query);
	if (!$result) {
		echo '<script>parent.errorAlert("Account could not be created. Error: '.mysqli_error($con).'","https://tdta.stthomas.edu/settings/admin/AddOrRemoveUser.php");</script>';
	} else {
		$multiquery = "
					INSERT INTO `users` (`username`, `fname`, `lname`, `bio`, `img_path`, `notes`, `phone_number`, `ust_id`) 
					VALUES ('$username', '$fname', '$lname', '', 'StudentRosterImages/PlaceholderImg.png', '', '', '$ust_id');

					INSERT into `megalink` (username, link1, link2, link3, link4, link5)
					VALUES ('$username', 'https://whd.stthomas.edu', 'http://www.stthomas.edu/its/', '', '', '');
					";
		$multiresult = mysqli_multi_query($con, $multiquery);
		if (!multiresult) {
			echo '<script>parent.warningAlert("User will be able to log in, but some information may be missing. Error: '.mysqli_error($con).'","https://tdta.stthomas.edu/settings/admin/AddOrRemoveUser.php");</script>';
		} else {
			echo '<script> parent.successAlert("User: <b>'.$username.'</b> successfully created.","https://tdta.stthomas.edu/settings/admin/AddOrRemoveUser.php"); </script>';
		}
	}
}
?>

</body>
</html>
