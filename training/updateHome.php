<?php
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
// Sanitize inputs
$body_orig = htmlentities($_POST['body'], ENT_QUOTES, 'UTF-8');
$body_fixed = str_replace("panel-collapse collapse in", "panel-collapse collapse", $body_orig);
// Set query
$query = "UPDATE `training_pages` SET `body` = '$body_fixed' WHERE id = -1;";
$result = mysqli_query($con,$query);
if(!$result) {
	//Insert something that would happen if the information was not placed in
	//the database correctly.
	echo '<script>parent.errorAlert("'.mysqli_error($con).'","#")</script>';
} else {
	echo '<script>parent.successAlert("Training Home has been updated.","https://tdta.stthomas.edu/training/TrainingHome.php")</script>';
}
?>
</body>
</html>
