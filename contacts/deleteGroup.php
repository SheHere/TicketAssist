<?php
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/SuperuserAuth.php');
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
//Called using confirmDelete() in /js/alerts.js
//Return 1 on success, 2 if trying to delete Other or Students, 3 if error when moving students
$to_delete = $_GET['id'];
//Do not allow group 'Other' to be deleted.
if($to_delete < 3){
	echo "The groups Student and Other cannot be deleted.";
}else{
	//First, move all contacts in the group to "Other"
	$move_sql = "UPDATE contactFTE SET grouping = 1 WHERE grouping = $to_delete;";
	$move_result = mysqli_query($con, $move_sql);
	if(!$move_result){
		echo "An error occurred while moving the group's users.";
	}else{
		$delete_sql = "DELETE FROM `contact_groups` WHERE `contact_groups`.`id` = $to_delete;";
		$delete_result = mysqli_query($con, $delete_sql);
		if(!$delete_result){
			echo "An error occurred while deleting the group.";
		}else{
			echo 1;
		}
	}
}