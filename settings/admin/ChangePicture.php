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
	include($_SERVER['DOCUMENT_ROOT'] . '/loginutils/AdminAuth.php');
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	include($_SERVER['DOCUMENT_ROOT'] . "/notifications/NewNotification.php"); 
	
	$username = $_SESSION['username'];
	$user = $_GET['user'];
	$query = "UPDATE `users` SET `img_path` = 'StudentRosterImages/RemovedByAdmin.png' WHERE username LIKE '$user'";
	$result = mysqli_query($con,$query);
	if(!$result){
		echo '<script> parent.errorAlert("'.mysqli_error($con).'","https://140.209.47.120/settings/admin/UserRoster.php");</script>';
	}else{
		echo '<script> parent.successAlert("Image was removed.","https://140.209.47.120/settings/admin/UserRoster.php");</script>';
		$recipient = $user;
		$title = 'Account Modified by Administator';
		$message = 'Your account picture has been removed by an Admin.';
		$all_tier = 0;
		newNotification($recipient, $title, $message, $all_tier);
	}
?>

</body>
</html>



