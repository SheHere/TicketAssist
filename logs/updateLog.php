<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
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
	$query = "";
	$numChanged = 0;
	$username = $_SESSION['username'];
	$query = "";
	foreach($_POST as $key=>$value){
		if(strpos($key, 'select') !== false){
			$tempkey = str_replace('select', '', $key);
			$query .= "UPDATE logs SET current_status = $value WHERE id = $tempkey; ";
		}
	}
	$result = mysqli_multi_query($con,$query);
	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo '<div class="alert alert-danger" role="alert"><strong>Oops!</strong> Something went wrong.';
		echo mysqli_error($con);
		echo '</div>';
	}
?>

</body>
</html>
