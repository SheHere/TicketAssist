<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php");
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

	$query = "";
	$numChanged = 0;
	$sql = "SELECT * FROM bugs WHERE status = 1";
	$result1 = mysqli_query($con,$sql);
	if (mysqli_num_rows($result1) > 0) {
		while($row = mysqli_fetch_assoc($result1)) {
			$cur_id = $row['id'];

			$submitted_by = $row['submitted_by'];
			$title = "Feedback Resolved";
			$message = "Your submitted feedback has been marked as resolved by an administrator. Thank you!";
			$all_tier = 0;

			if(isset($_POST[$cur_id])){
				$newStatus = $_POST[$cur_id];
				if($row['status'] != $newStatus){
					$numChanged += 1;
					$query = $query . "UPDATE `bugs` SET `status` = $newStatus WHERE id = $cur_id; ";
					newNotification($submitted_by, $title, $message, $all_tier);
				}
				$cur_id = 0;
			}
		}
		$result2 = mysqli_multi_query($con,$query);
		if(!$result2) {
			echo '<script> parent.errorAlert("'. mysqli_error($con) .'","https://tdta.stthomas.edu/dev/ViewFeedback.php");</script>';
		} else {
			if ($numChanged == 0) {
				echo '<script> parent.warningAlert("No changes detected.","https://tdta.stthomas.edu/dev/ViewFeedback.php");</script>';
			} else {
				echo '<script> parent.successAlert("Status has been updated for ' . $numChanged . ' bugs.","https://tdta.stthomas.edu/dev/ViewFeedback.php"); </script>';
			}
		}
	}else{
		echo '<script> parent.errorAlert("No rows found.", "https://tdta.stthomas.edu/dev/ViewFeedback.php");</script>';
	}
?>

</body>
</html>
