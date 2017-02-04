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
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

	$username = $_SESSION['username'];
	$color = $_POST['color'];

	$query = "UPDATE `users` SET `color` = '$color' WHERE `users`.`username` = '$username';";
	$result = mysqli_query($con,$query);

	if(!$result) {
	   echo '<script>parent.errorAlert("'.mysqli_error($con).'");</script>';
	}
?>

</body>
</html>
