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
	
	$user_to_delete = $_POST['user_to_delete'];
	$user_to_delete2 = $_POST['user_to_delete2'];
	if(strcmp($user_to_delete, $user_to_delete2) == 0){
		$sql = "SELECT username FROM login WHERE username LIKE '$user_to_delete';";
		$check = mysqli_query($con,$sql);
		if(mysqli_num_rows($check) == 1){
			$query = "DELETE FROM `badges_held` WHERE username LIKE '$user_to_delete'; ";
			$query .= "DELETE FROM `login` WHERE username LIKE '$user_to_delete'; ";
			$query .= "DELETE FROM `megalink` WHERE username LIKE '$user_to_delete'; ";
			$query .= "DELETE FROM `users` WHERE username LIKE '$user_to_delete'; ";
			$result = mysqli_multi_query($con,$query);
			if(!$result){
				echo '<script> parent.errorAlert("'.mysqli_error($con).'","https://tdta.stthomas.edu/settings/admin/AddOrRemoveUser.php?tab=remove");</script>';
			}else{
				echo '<script> parent.successAlert("User was deleted.","https://tdta.stthomas.edu/settings/admin/AddOrRemoveUser.php");</script>';
			}
		}else{
			echo '<script> parent.errorAlert("Username does not exist. Check your spelling and try again.","https://tdta.stthomas.edu/settings/admin/AddOrRemoveUser.php?tab=remove");</script>';
		}
	}else{
		echo '<script> parent.errorAlert("The two submitted usernames do not match. Check your spelling and try again.","https://tdta.stthomas.edu/settings/admin/AddOrRemoveUser.php?tab=remove");</script>';
	}
?>

</body>
</html>



