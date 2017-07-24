<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); ?>
<!--
<--- Nick Scheel and Chase Ingebritson 2016
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
	include($_SERVER['DOCUMENT_ROOT'] . '/loginutils/auth.php');
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	
	$username = $_SESSION['username'];
	$link1url = $_POST['link1url'];
	$link2url = $_POST['link2url'];
	$link3url = $_POST['link3url'];
	$link4url = $_POST['link4url'];
	$link5url = $_POST['link5url'];

	$query = "UPDATE `megalink` SET `link1` = '$link1url', `link2` = '$link2url', `link3` = '$link3url', `link4` = '$link4url', `link5` = '$link5url' WHERE `megalink`.`username` = '$username';";
	$result = mysqli_query($con,$query);
	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo '<script>parent.errorAlert("'.mysqli_error($con).'","https://tdta.stthomas.edu/settings/user/UserSettings.php");</script>';
	} else {echo '<script>parent.successAlert("Megalink successfully updated!","https://tdta.stthomas.edu/settings/user/UserSettings.php");</script>';}
?>

</body>
</html>