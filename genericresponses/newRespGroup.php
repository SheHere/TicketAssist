<?php
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/SuperuserAuth.php');
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

$newName = $_POST['newGroup'];
$newgroup_sql = "INSERT INTO `genericResponseGroups` (`id`, `group_name`, `ordering`) VALUES (NULL, '$newName', '2');";
$insert_result = mysqli_query($con, $newgroup_sql);
if($insert_result){
	$success_message .= 'New group \"' . $newName . '\" has been added. ';
	echo '<script> parent.parent.successAlert("' . $success_message . '", "https://tdta.stthomas.edu/assistant.php" );</script>';
}else{
	$failure_message .= "An error occured: " . mysqli_error($con);
	echo '<script> parent.parent.errorAlert("' . $failure_message . '", "https://tdta.stthomas.edu/assistant.php" );</script>';
}
