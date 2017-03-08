<?php
/* ATTRIBUTES:
 * id - auto-increment variable to ensure unique-ness - set to NULL always
 * date_created - time the notification was created - set to NULL always
 * viewed - 1 if "new", 0 otherwise - set to 1 when creating a new notification
 * username - recipient for the notification, a specific user - set to who should be receiving the notification
 * title - title of the notification. Keep it short
 * message - body of the notification, usually contains a link to view whatever triggered it
 * all_admin - int that determines if it is a user-tier-wide notification - set to 1, 2, or 3 if it is for all users of a particular level, set to 0 otherwise.
*/

function newNotification($recipient, $title, $message, $all_tier) {
  require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

  $title_fixed = htmlentities($title, ENT_QUOTES, 'UTF-8');
  $message_fixed = nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8'));
  $recipient_fixed = htmlentities($recipient, ENT_QUOTES, 'UTF-8');

  $notificationquery = 'INSERT INTO `notifications` (id, date_created, viewed, dismissed, username, title, message, all_admin) VALUES(NULL, NULL, 1, 1, "'.$recipient_fixed.'", "'.$title_fixed.'", "'.$message_fixed.'", '.$all_tier.');';

  $result = mysqli_query($con,$notificationquery);
  if(!$result) {
		echo mysqli_error($con);
	}
}

?>
