<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
	include($_SERVER['DOCUMENT_ROOT'] . "/includes/AdminAuth.php");
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
</head>

<body>

<?php		 
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	include($_SERVER['DOCUMENT_ROOT'] . "/notifications/NewNotification.php");
	$submittedBy = $_POST['submittedBy'];
	$url = str_replace("'","",$_POST['url']);
	$note = htmlentities($_POST['note'], ENT_QUOTES, 'UTF-8');
	
	//Default status is NULL, which is 1. 1 means open, 0 is resolved.
	$query = "
	INSERT INTO `bugs` (submitted_by, url, note) 
	VALUES ('$submittedBy', '$url', '$note');
	";
	$result = mysqli_query($con,$query);
	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo '<script> parent.errorAlert("'. mysqli_error($con) .'","https://tdta.stthomas.edu/dev/SubmitFeedback.php");</script>';
	} else {
		echo '<script> parent.successAlert("Feedback for:'.$url.' has been received.","http://tdta.stthomas.edu/assistant/assistant.php"); </script>';
		$recipient = "sche0210";
		$title = 'New Feedback Submitted';
		$message = 'Feedback has been submitted by: <strong>'.$submittedBy.'</strong>. View it <a href="https://tdta.stthomas.edu/dev/ViewFeedback.php">here</a>.';
		$all_tier = 0;
		newNotification($recipient, $title, $message, $all_tier);
	}
?>

</body>
</html>

