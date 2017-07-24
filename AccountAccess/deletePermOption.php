<?php
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
$toDelete = $_POST['toDelete'];
//Delete from both td_perm_names and td_perm_users
$deleteQuery = "DELETE FROM td_perm_names WHERE perm_id = $toDelete;";
$deleteQuery .= "DELETE FROM td_perm_users WHERE perm_id = $toDelete;";
$result = mysqli_multi_query($con, $deleteQuery);
if($result){
	echo "success";
}else{
	echo mysqli_error($con);
}
