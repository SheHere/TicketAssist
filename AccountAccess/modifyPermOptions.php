<?php
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

$update_sql = '';
//Loops through all POST data that begins 'group', and creates a multiquery to update title for each regardless of whether they are different.
foreach($_POST as $k => $input) {
	if(strpos($k, 'perm') === 0) {
		$perm_id = str_replace('perm', '', $k);
		$perm_name = htmlentities($input);
		//Concat onto update_sql
		$update_sql .= "
		UPDATE `td_perm_names` 
		SET `perm_name` = '$perm_name' 
		WHERE `td_perm_names`.`perm_id` = $perm_id;
		";
	}
	if(strpos($k, 'process') === 0) {
		$perm_id = str_replace('process', '', $k);
		$process_id = $input;
		//Concat onto update_sql
		$update_sql .= "
		UPDATE `td_perm_names` 
		SET `process_id` = '$process_id' 
		WHERE `td_perm_names`.`perm_id` = $perm_id;
		";
	}
}
//Submit query
$update_result = mysqli_multi_query($con, $update_sql);
if($update_result){
	echo "success";
}elseif(!$update_result){
	echo mysqli_error($con);
}