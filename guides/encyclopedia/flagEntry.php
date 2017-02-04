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
	
	
	$id = $_POST['toFlag'];
	$flagged = $_POST['flaggedBy'];
	$sql = "UPDATE `encyclopedia` SET status = 2, flaggedBy = '$flagged' WHERE count = '$id'";
	$result = mysqli_query($con,$sql);
	if(!$result) {
		echo '<div class="alert alert-danger" role="alert"><strong>Oops!</strong> Something went wrong. ';
		echo mysqli_error($con);
		echo '</div>';
	} else {
		echo '<div class="alert alert-success" role="alert"><strong>Success!</strong> Entry was flagged for administative attention.</div>';
	}
?>

</body>
</html>

