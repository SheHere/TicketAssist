<?php

	function newNotification($recipient, $title, $message, $all_tier){
	require('loginutils/connectdb.php');

		$title_fixed = htmlentities($title, ENT_QUOTES, 'UTF-8');
		$message_fixed = nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8'));
		$recipient_fixed = htmlentities($recipient, ENT_QUOTES, 'UTF-8');

		$notificationquery = 'INSERT INTO `notifications` (id, date_created, viewed, dismissed, username, title, message, all_admin) 
							  VALUES(NULL, NULL, 1, 1, "'.$recipient_fixed.'", "'.$title_fixed.'", "'.$message_fixed.'", '.$all_tier.');';

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
		SELECT `logs`.`username`, fname, lname, count(id)
		FROM `logs` 
		LEFT JOIN `users` ON `logs`.`username` = `users`.`username`
		WHERE current_status = 1
		GROUP BY `logs`.`username`";
	$find_result = mysqli_query($con,$find_query);
	if( mysqli_num_rows($find_result) > 0 ){
		//If there are open logs, find username and how many logs that user has open
		$message = '<ul style="line-height: .75">';
		while($row = mysqli_fetch_assoc($find_result)){
			$lname = $row['lname'];
			$fname = $row['fname'];
			$cur_user = $row['username'];
			$log_count = $row['count(id)'];
			$message .= '<li>' . $lname . ', ' . $fname . ' ('.$cur_user.'); Open Logs: '.$log_count.'</li>
			';
			//Generate notification for each user so that they know to resolve their logs.
			$user_note_title = "Active Logs Need Attention";
			$user_note_msg = "{$fname},<br><br>It appears that you have {$log_count} open log(s) that were not resolved ";
			$user_note_msg .= "by 8:00pm last night.<br>Please be sure to create tickets for each log you create so that all of your work is properly ";
			$user_note_msg .= "documented.<br><br><i>This is an automated message. Please see an administrator for more information.</i>";
			newNotification($cur_user, $user_note_title, $user_note_msg, 0);
		}
		$message .= '</ul>To view details on these logs, visit the <a href="https://tdta.stthomas.edu/logs/logIndex.php">Log Index</a> and search by username.';
		//If there are no open logs, reports none found.
	}else{
		$message = "There are currently no unresolved logs.";
	}

	//Send notification to administrators
	$recipient = 'sche0210';
	$today = date("F j, Y");
	$title = $today . ' - Active Logs Report';
	$all_tier = 0;

	newNotification($recipient, $title, $message, $all_tier);
	$recipient = "ebinfa";
	newNotification($recipient, $title, $message, $all_tier);

	
?>