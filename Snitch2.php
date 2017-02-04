<?php
	function newNotification($recipient, $title, $message, $all_tier) {
		require('loginutils/connectdb.php');

		$title_fixed = htmlentities($title, ENT_QUOTES, 'UTF-8');
		$message_fixed = nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8'));
		$recipient_fixed = htmlentities($recipient, ENT_QUOTES, 'UTF-8');

		$notificationquery = 'INSERT INTO `notifications` (id, date_created, viewed, dismissed, username, title, message, all_admin) VALUES(NULL, NULL, 1, 1, "'.$recipient_fixed.'", "'.$title_fixed.'", "'.$message_fixed.'", '.$all_tier.');';

		$result = mysqli_query($con,$notificationquery);
		if(!$result) {
			echo mysqli_error($con);
		}
		}
	
	//Connect to database
	require('loginutils/connectdb.php');
	
	//Query looks for open logs and counts them per user
	$message = "Script Error: message variable not correctly set.";
	$find_query = "
		SELECT username, count(id)
		FROM `logs`
		WHERE current_status = 1
		GROUP BY username";
	$find_result = mysqli_query($con,$find_query);
	if( mysqli_num_rows($find_result) > 0 ){
		//If there are open logs, find username and how many logs that user has open
		$message = 'Active Logs:<br>';
		while($row = mysqli_fetch_assoc($find_result)){
			$message .= 'User: '.$row['username'].'; Open Logs: '.$row['count(id)'].'
			';
		}
		$message .= 'To view details on these logs, visit the <a href="https://140.209.47.120/logs/logIndex.php">Log Index</a> and search by username.';
		//If there are no open logs, reports none found.
	}else{
		$message = "There are currently no unresolved logs.";
	}
	//Send notification
	$recipient = 'sche0210';
	$title = 'Active Logs Report';
	$all_tier = 0;

	newNotification($recipient, $title, $message, $all_tier);
	
	
?>