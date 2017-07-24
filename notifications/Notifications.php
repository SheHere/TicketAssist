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
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	reducedHeader();
	?>
	<link rel="stylesheet" href="../styles/notifications.css">
	<base target="_parent">
	<script>
        $( document ).ready(function() {
            $(".dismiss").click( function () {

                if (parseInt(parent.document.getElementById("badge").innerHTML) - 1 <= 0 || parent.document.getElementById("badge").innerHTML == "") {
                    parent.document.getElementById("badge").innerHTML = "";
                } else {
                    parent.document.getElementById("badge").innerHTML = (parent.document.getElementById("badge").innerHTML - 1).toString();
                }
            });
        });
	</script>
</head>

<body>
<?php
//Connect to db
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

//Set current username and admin status
$cur_username = $_SESSION['username'];
$cur_status = $_SESSION['admin_status'];

//By default, grabs only notifications that have not yet been dismissed
$query_build = "AND dismissed = 1";
//If $_GET is set, grab all valid notifications regardless of the dismissed field
if (isset($_GET['get'])) {
	$query_build = "";
}

//Query grabs all announcements associated with the user and their administrative level, accounting for $query_build above
$sql = "
		SELECT * 
		FROM notifications 
		WHERE (username LIKE '$cur_username' OR all_admin = $cur_status) " . $query_build . "
		ORDER BY date_created DESC;";
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) { //If at least 1 notification is found:
	//Initialize printConcat, which will be printed at the end.
	$printConcat = "";

	//If all notifications are being shown, display link to show less at the top
	if (isset($_GET['get'])) {
		$printConcat .= '<br><p style="text-align: center"><a target="_self" href="https://tdta.stthomas.edu/notifications/Notifications.php">Show less Notifications</a></p><hr>';
	}

	// process data for each row
	while ($row = mysqli_fetch_assoc($result)) {
		//Set variables
		$notification_id = $row['id'];
		$date_created = $row['date_created'];
		$title = html_entity_decode($row['title']);
		$message = html_entity_decode($row['message']);
		$viewed = $row['viewed'];
		$dismissed = $row['dismissed'];

		//Set show_new and show_dismissed_link to empty
		$show_new = '';
		$show_dismissed_link = '&nbsp;';
		//If the notification has been marked as seen, do not show "new" badge
		if ($viewed == 1) {
			$show_new = '<a class="dismiss" href="https://tdta.stthomas.edu/notifications/readNotification.php?id=' . $notification_id . '" target="iFrame"><span class="label label-default">New</span></a>';
		}
		//If the notification has been dismissed, do not show link to dismiss it, as it is redundant.
		if($dismissed == 1 && $viewed == 1){
			$show_dismissed_link = '<p style="text-align: center;"><a class="dismiss" href="https://tdta.stthomas.edu/notifications/DismissNotification.php?id=' . $notification_id . '" target="iFrame">Dismiss</a></p>';
		}
		if($dismissed == 1 && $viewed != 1){
			//Don't decrease badge number if it is already marked as viewed
			$show_dismissed_link = '<p style="text-align: center;"><a href="https://tdta.stthomas.edu/notifications/DismissNotification.php?id=' . $notification_id . '" target="iFrame">Dismiss</a></p>';
		}

		//Set default glyph, changing it if the notification icon matches a set title
		$glyph = '<span class="glyphicon glyphicon-triangle-right"></span>';
		if (strcmp($title, "Access Request") == 0) {
			$glyph = '<span class="glyphicon glyphicon-user"></span>';
		} else if (strcmp($title, "New Feedback Submitted") == 0) {
			$glyph = '<span class="glyphicon glyphicon-alert"></span>';
		} else if (strcmp($title, "Account Modified by Administator") == 0) {
			$glyph = '<span class="glyphicon glyphicon-remove"></span>';
		} else if (strcmp($title, "Active Logs Report") == 0) {
			$glyph = '<span class="glyphicon glyphicon-folder-open"></span>';
		}

		//Build printConcat with the information set above.
		$printConcat .= '
			<div class="media">
				<div class="media-left">
					' . $glyph . '
					<!--<img src="notification_img.png" class="media-object" style="width:45px">-->
				</div>
				<div class="media-body">
					<h4 class="media-heading">' . $title . ' <small><i> ' . $date_created . ' </i></small>' . $show_new . '</h4>
					<p>' . $message . '</p>
				</div>
				<div class="media-right">
					'. $show_dismissed_link .'
				</div>
			</div>
			';
	} //End of while loop, all notifications have been processed
	echo $printConcat . '
		<br>
		<p style="text-align: center"><a target="_self" href="https://tdta.stthomas.edu/notifications/Notifications.php?get=more">Show All Notifications</a></p>';
} else { //If no notifications are found:
	echo '<div class="well" style="text-align: center; margin-top: 20px;"><h4>No notifications!</h4></div><p style="text-align: center"><a target="_self" href="https://tdta.stthomas.edu/notifications/Notifications.php?get=more">Show All Notifications</a></p>';
}

?>

<iframe name="iFrame" width="auto" height="autopx" frameBorder="0" style="display: none;"></iframe>
</body>
</html>
