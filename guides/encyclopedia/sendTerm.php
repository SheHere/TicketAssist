<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
--->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../../styles/assistant.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/jquery-3.1.1.min.js"></script>
</head>

<body>

<?php
			 
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	
	$username = $_SESSION['username'];
	$term = $_POST['term'];
	$topic = $_POST['topicselect'];
	$description = $_POST['description'];
	$guide = $_POST['guide'];
	$keyword1 = $_POST['keyword1'];
	$keyword2 = $_POST['keyword2'];
	$keyword3 = $_POST['keyword3'];
	$status = $_POST['statusselect'];
	if(strcmp($status, "denied")==0){$statusNum = 0;}
	if(strcmp($status, "pending")==0){$statusNum = 1;}
	if(strcmp($status, "flagged")==0){$statusNum = 2;}
	if(strcmp($status, "approved")==0){$statusNum = 3;}
	
	$sql = "SELECT * FROM encyclopedia WHERE vocab_term LIKE '$term'";
	$testResult = mysqli_query($con,$sql);
	if (mysqli_num_rows($testResult) > 0) {
		$query = "UPDATE `encyclopedia` SET `vocab_term` = '$term', `topic` = '$topic', `description` = '$description', `guide` = '$guide', `keyword1` = '$keyword1', `keyword2` = '$keyword2', `keyword3` = '$keyword3', `status` = '$statusNum', `approvedBy` = '$username' WHERE vocab_term LIKE '$term';";
		$success = '<div class="alert alert-success" role="alert"><strong>Success!</strong> The entry has been updated.</div>';
	}else{
		$query = "INSERT INTO `encyclopedia` (`count`, `author`, `vocab_term`, `topic`, `description`, `guide`, `keyword1`, `keyword2`, `keyword3`, `status`, `approvedBy`, `flaggedBy`) VALUES (NULL, '$term', '$username', '$topic', '$description', '$guide', '$keyword1', '$keyword2', '$keyword3', '1', '', '');";
		$success = '<div class="alert alert-success" role="alert"><strong>Success!</strong> Your entry has been sent. Please wait for administrative approval.</div>';
	}
	$result = mysqli_query($con,$query);
	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo '<div class="alert alert-danger" role="alert"><strong>Oops!</strong> Something went wrong. ';
		echo mysqli_error($con);
		echo '</div>';
	} else {
		echo $success;
	}
?>

</body>
</html>

