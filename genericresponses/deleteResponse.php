<?php
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/SuperuserAuth.php');
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
//Called using confirmDelete() in /js/alerts.js
//Return 1 on success, 2 if trying to delete Other or Students, 3 if error when moving students
$to_delete = $_GET['id'];
$delete_sql = "DELETE FROM `genericResponse` WHERE `genericResponse`.`id` = $to_delete;";
$delete_result = mysqli_query($con, $delete_sql);
if(!$delete_result){
	echo "An error occurred while deleting the group.";
}else{
	echo 1;
}