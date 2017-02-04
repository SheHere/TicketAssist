<?php require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$cur_username = $_SESSION['username'];
	$cur_status = $_SESSION['admin_status'];
	$sql = "SELECT * FROM notifications WHERE (username LIKE '$cur_username' OR all_admin = $cur_status) AND viewed = 1;";
	$result = mysqli_query($con, $sql);
	$num_notifications = mysqli_num_rows($result);
	$num_show = '';	
	if($num_notifications > 0){
		$num_show = '<span class="badge">'.$num_notifications.'</span>';
	}
?>