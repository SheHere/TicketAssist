<?php
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/SuperuserAuth.php');
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');


$success = 0;
$success_message = '';
$failure_message = '';

$update_sql = '';
//Loops through all POST data that begins 'group', and creates a multiquery to update title for each regardless of whether they are different.
foreach($_POST as $k => $group_name) {
	if(strpos($k, 'group') === 0) {
		$group_id = str_replace('group', '', $k);
		$group_name = addslashes($group_name);
		if($group_id >= 3){ //This prevents Student and Other from beging renamed
			$update_sql .= "
        	UPDATE `genericResponseGroups` 
        	SET `group_name` = '$group_name' 
        	WHERE `genericResponseGroups`.`id` = $group_id;
        	";
		}
	}
}
$update_result = mysqli_multi_query($con, $update_sql);
if($update_result){
	$success = 1;
	$success_message .= "Update successful. ";
}elseif(!$update_result){
	$failure_message .= "An error occured: \n" . mysqli_error($con);
}

//Call alert for success or failure message
if($success > 0){
	echo '<!DOCTYPE html>
<script> parent.parent.successAlert("' . $success_message . '", "https://140.209.47.120/assistant.php") </script>
';
}else{
	echo '<!DOCTYPE html>
<script>parent.parent.errorAlert("' . $failure_message . '", "https://140.209.47.120/assistant.php")</script>
';
}