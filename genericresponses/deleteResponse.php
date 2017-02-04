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

	require($_SERVER['DOCUMENT_ROOT'] . "/loginutils/connectdb.php");
	
	$toRemove = $_POST['toRemove'];
	if(empty($toRemove)){
		echo '<script> parent.warningAlert("You did not select anything.", "https://140.209.47.120/genericresponses/EditResponses.php?tab=remove");</script>';
	} else {
		$num = count($toRemove);
		$multiquery = '';
		for($i=0; $i < $num; $i++){
			$multiquery .= "DELETE FROM `genericResponse` WHERE `genericResponse`.`id` = " . $toRemove[$i] . "; ";
		}
		$result = mysqli_multi_query($con,$multiquery);
		if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo '<script> parent.errorAlert("Something went wrong...", "https://140.209.47.120/genericresponses/EditResponses.php?tab=remove");</script>';
	} else {
		echo '<script> parent.successAlert("The selected responses have been removed.", "https://140.209.47.120/genericresponses/EditResponses.php?tab=remove"); </script>';
	}
		
	}
	
?>

</body>
</html>

