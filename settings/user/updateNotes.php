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
	$notes_text = addslashes($_POST['notes_text']);
	
	$query = "UPDATE `users` SET `notes` = '$notes_text' WHERE `users`.`username` = '$username';";
	$result = mysqli_query($con,$query);
	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo '<script>parent.errorAlert("'.mysqli_error($con).'","https://140.209.47.120/settings/user/UserSettings.php");</script>';
		echo mysqli_error($con);
	}
?>

</body>
</html>