<?php
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
$newPerm = htmlentities($_POST['newPerm']);
$newProcess = $_POST['newProcess'];
//Delete from both td_perm_names and td_perm_users
$addQuery = "INSERT INTO td_perm_names (perm_id, perm_name, process_id) VALUES (NULL, '$newPerm', $newProcess);";
$result = mysqli_query($con, $addQuery);
if($result){
	echo "success";
}else{
	echo mysqli_error($con);
}
