<?php
if(isset($_POST['username']) && isset($_POST['admin_status'])){
	//Counts notifications and changes the badge number
		//Connect to DB
		require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
		//Count unread notifications
		$cur_username = $_POST['username'];
		$cur_status = $_POST['admin_status'];
		$sql = "SELECT * FROM notifications WHERE (username LIKE '$cur_username' OR all_admin = $cur_status) AND viewed = 1;";
		$result = mysqli_query($con, $sql);
		if($result){
			$num_notifications = mysqli_num_rows($result);
			echo $num_notifications;
		}else{
			echo "error";
		}
}