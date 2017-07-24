<?php
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/SuperuserAuth.php');
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

$newTitle = $_POST['newGroup'];
$newgroup_sql = "INSERT INTO `contact_groups` (`id`, `group_name`, `ordering`) VALUES (NULL, '$newTitle', '2');";
$insert_result = mysqli_query($con, $newgroup_sql);
if($insert_result){
    $success_message .= 'New group \"' . $newTitle . '\" has been added. ';
    echo '<script> parent.parent.successAlert("' . $success_message . '", "https://tdta.stthomas.edu/assistant/assistant.php" );</script>';
}else{
    $failure_message .= "An error occured: " . mysqli_error($con);
    echo '<script> parent.parent.errorAlert("' . $failure_message . '", "https://tdta.stthomas.edu/assistant/assistant.php" );</script>';
}
