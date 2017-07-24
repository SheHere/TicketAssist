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
	
	$query = "";
	$numChanged = 0;
	$sql = "SELECT username, admin_status, role FROM login WHERE NOT(role = -1)";
	
	$result1 = mysqli_query($con,$sql);
	
	if (mysqli_num_rows($result1) > 0) {
		
		while($row = mysqli_fetch_assoc($result1)) {
			$cur_username = $row['username'];
			//Update the admin status if it's different than what's in the table
			if(isset($_POST[$cur_username . "StatusSelection"])){
				$newStatus = $_POST[$cur_username . "StatusSelection"];
				if($row['admin_status'] != $newStatus){
					$numChanged += 1;
					$title = 'Admin Status Updated';
					$message = 'Your admin status has been modified.';
					if($newStatus == 1){
						$message .= ' You are now a <strong>User</strong>.';
					}else if($newStatus == 2){
						$message .= ' You are now a <strong>Superuser</strong>.';
					}else if($newStatus == 3){
						$message .= ' You are now a <strong>Admin</strong>.';
					}
					$query .= "UPDATE `login` 
					SET `admin_status` = $newStatus 
					WHERE username = '$cur_username';
					
					INSERT INTO `notifications` (id, date_created, viewed, username, title, message, all_admin) 
					VALUES(NULL, NULL, 1, '$cur_username', '$title', '$message', 0);";
				}
			}
			
			//Update the role if it's different than what's in the table
			if(isset($_POST[$cur_username . "RoleSelection"])){
				$newRole = $_POST[$cur_username . "RoleSelection"];
				if($row['role'] != $newRole) {
					$numChanged += 1;
					$query .= "UPDATE `login` SET `role` = $newRole WHERE username LIKE '$cur_username'; ";
				}
			}
		}
		
		//Runs the status query and checks the result
		$statusResult = mysqli_multi_query($con,$query);
		if(!$statusResult) {
			echo '<script>parent.errorAlert("Error: '.mysqli_error($con).'\nQuery:'.$query.'","https://tdta.stthomas.edu/settings/admin/UserRoster.php"); </script>';
		} else {
			if($numChanged == 0){
				echo '<script>parent.warningAlert("No entries were changed.","https://tdta.stthomas.edu/settings/admin/UserRoster.php");</script>';
			}else{
				echo '<script>parent.successAlert("User status has been updated for '.$numChanged.' users.","https://tdta.stthomas.edu/settings/admin/UserRoster.php")</script>';}
		}
		
	}else{echo '<script>parent.warningAlert("No rows found.","https://tdta.stthomas.edu/settings/admin/UserRoster.php");</script>';}
?>

</body>
</html>
