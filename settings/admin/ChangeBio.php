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
<style>
body {
	padding-right: 5px;
}
h2 {
	margin: 0px;
	padding: 0px;
}
</style>
</head>

<body>

<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/loginutils/AdminAuth.php');
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	include($_SERVER['DOCUMENT_ROOT'] . "/notifications/NewNotification.php"); 
	
	$username = $_SESSION['username'];
	$user = $_GET['user'];
	$query = "UPDATE `users` SET `bio` = '&lt;p&gt;This user&#039;s bio was removed by an admin user.&lt;/p&gt;' WHERE username LIKE '$user'";
	$result = mysqli_query($con,$query);
	if(!$result){
		echo '<script> parent.errorAlert("'.mysqli_error($con).'","https://tdta.stthomas.edu/settings/admin/UserRoster.php");</script>';
	}else{
		echo '<script> parent.successAlert("Bio was replaced. A notification has been sent to <strong>'.$user.'</strong>.","https://tdta.stthomas.edu/settings/admin/UserRoster.php");</script>';
		$recipient = $user;
		$title = 'Account Modified by Administator';
		$message = 'Your account bio has been set to default by an Admin.';
		$all_tier = 0;
		newNotification($recipient, $title, $message, $all_tier);
	}
?>

</body>
</html>



