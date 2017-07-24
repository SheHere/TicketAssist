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
$toDelete = $_POST['toDelete'];

$query = "DELETE FROM `training_pages` WHERE `id` = '$toDelete';";
$result = mysqli_query($con,$query);
if(!$result) {
	//Insert something that would happen if the information was not placed in
	//the database correctly.
	echo '<script>parent.errorAlert("'.mysqli_error($con).'","https://tdta.stthomas.edu/training/EditTrainingGuide.php?guide='.str_replace(' ', '', $toDelete).'")</script>';
} else {
	echo '<script>parent.successAlert("The guide has been removed.","https://tdta.stthomas.edu/training/TrainingHome.php")</script>';
}
?>

</body>
</html>
