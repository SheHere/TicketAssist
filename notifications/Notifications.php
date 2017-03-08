<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->
<!DOCTYPE html>
<html>
<head>
<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php'); 
	reducedHeader();
?>
  <link rel="stylesheet" href="../styles/notifications.css">
  <base target="_parent">
</head>

<body>
<?php
	$query_build = "AND dismissed = 1";
	if(isset($_GET['get'])){
		$query_build = "";
	}
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$cur_username = $_SESSION['username'];
	$cur_status = $_SESSION['admin_status'];
	//Query grabs all announcments associated with the user and their administrative level.
	$sql = "
		SELECT * 
		FROM notifications 
		WHERE (username LIKE '$cur_username' OR all_admin = $cur_status) ".$query_build."
		ORDER BY date_created DESC;";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) {
		$printConcat = "";
		// output data of each row
		$counting = 0;
		while($row = mysqli_fetch_assoc($result)) {	
			$notification_id = $row['id'];
			$date_created = $row['date_created'];
			$title = html_entity_decode($row['title']);
			$message = html_entity_decode($row['message']);
			$viewed = $row['viewed'];
			$show_new = '';
				if($viewed == 1){
					$show_new = '<a href="https://140.209.47.120/notifications/readNotification.php?id='.$notification_id.'" target="iFrame"><span class="label label-default">New</span></a>';
				}
			$glyph = '<span class="glyphicon glyphicon-triangle-right"></span>';
			if(strcmp($title,"Access Request") == 0){
				$glyph = '<span class="glyphicon glyphicon-user"></span>';
			}
			else if(strcmp($title,"New Feedback Submitted") == 0){
				$glyph = '<span class="glyphicon glyphicon-alert"></span>';
			}
			else if(strcmp($title,"Account Modified by Administator") == 0){
				$glyph = '<span class="glyphicon glyphicon-remove"></span>';
			}else if(strcmp($title,"Active Logs Report") == 0){
				$glyph = '<span class="glyphicon glyphicon-folder-open"></span>';
			}
			$printConcat .= '
			<div class="media">
				<div class="media-left">
					'.$glyph.'
					<!--<img src="notification_img.png" class="media-object" style="width:45px">-->
				</div>
				<div class="media-body">
					<h4 class="media-heading">' . $title . ' <small><i> '.$date_created.' </i></small>'.$show_new.'</h4>
					<p>'.$message.'</p>
				</div>
				<div class="media-right">
					<p style="text-align: center;"><a href="https://140.209.47.120/notifications/DismissNotification.php?id='.$notification_id.'" target="iFrame">Dismiss</a></p>
				</div>
			</div>
			';
		}
		echo $printConcat . '
		<br>
		<p style="text-align: center"><a target="_self" href="https://140.209.47.120/notifications/Notifications.php?get=more">Show All Notifications</a></p>';
	} else {
		echo '<div class="well" style="text-align: center; margin-top: 20px;"><h4>No notifications!</h4></div><p style="text-align: center"><a target="_self" href="https://140.209.47.120/notifications/Notifications.php?get=more">Show All Notifications</a></p>';
	}

?>

<iframe name="iFrame" width="auto" height="autopx" frameBorder="0" style="display: none;" ></iframe>
</body>
</html>
