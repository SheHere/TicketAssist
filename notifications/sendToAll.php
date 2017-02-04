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

	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	require($_SERVER['DOCUMENT_ROOT'] . '/notifications/NewNotification.php');
	
	$title = $_POST['title'];
	$message = $_POST['message'];
	if(strcmp('',$message)==0){
		echo '<script> parent.warningAlert("Message is empty.", "http://140.209.47.120/announcements/Announcements.php");</script>';
	}else{
		$query = "
		SELECT username
		FROM `login`";
		$result = mysqli_query($con,$query);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			$all_tier = 0;
			while($row = mysqli_fetch_assoc($result)) {
				$recipient = $row['username'];
				newNotification($recipient, $title, $message, $all_tier);
			}
			echo '<script> parent.successAlert("Your notification has been sent.", "http://140.209.47.120/assistant.php"); </script>';
		}else{
			echo '<script> parent.errorAlert("Error: No users found. Contact an Administrator.", "https://140.209.47.120/notifications/NotifyAll.php");</script>';
			}
	}
?>

</body>
</html>
