<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");
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
<base target="_blank" />
</head>

<body>

<?php

	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

	$username = $_SESSION['username'];

	//$guide_name = $_POST['title'];
	$guide_name = htmlentities($_POST['title'], ENT_QUOTES, 'UTF-8');

	//$topic = $_POST['topicselect'];
	$topic = htmlentities($_POST['topicselect'], ENT_QUOTES, 'UTF-8');

	//$overview = addslashes($_POST['overview']);
	$overview = htmlentities($_POST['overview'], ENT_QUOTES, 'UTF-8');

	//$body = addslashes($_POST['body']);
	$body_orig = htmlentities($_POST['body'], ENT_QUOTES, 'UTF-8');
	$body_fixed = str_replace("panel-collapse collapse in", "panel-collapse collapse", $body_orig);
	
	$filename = str_replace(' ', '', $guide_name);

	$sql = "SELECT * FROM guides WHERE guide_name LIKE '$guide_name'";
	$testResult = mysqli_query($con,$sql);
	if (mysqli_num_rows($testResult) > 0) {
		$query = "UPDATE `guides` SET `topic` = '$topic', `guide_name` = '$guide_name', `filename` = '$filename', `overview` = '$overview',  `body` = '$body_fixed' WHERE `guide_name` = '$guide_name';";
	}else{
		$query = "INSERT INTO `guides` (`topic`, `guide_name`, `filename`, `overview`, `body`) VALUES ('$topic', '$guide_name', '$filename', '$overview', '$body_fixed');";
	}
	$result = mysqli_query($con,$query);
	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo '<script>parent.errorAlert("'.mysqli_error($con).'","https://140.209.47.120/guides/NewGuide.php")</script>';
	} else {
		echo '<script>parent.successAlert("The guide has been sent.","https://140.209.47.120/guides/Guide.php?guide=' .$filename. '")</script>';
	}
?>

</body>
</html>
