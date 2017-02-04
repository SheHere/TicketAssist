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

	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

	$title = htmlentities($_POST['title'], ENT_QUOTES, 'UTF-8');
	$message = nl2br(htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8'));
	$cur_user = $_SESSION['username'];
	
	if(strcmp('',$message)==0){
		echo '<script> parent.warningAlert("Message is empty.", "https://140.209.47.120/genericresponses/EditResponses.php");</script>';
	}else{
		$query = "INSERT INTO `genericResponse` (`id`, `username`, `title`, `msg_body`) VALUES (NULL, '$cur_user', '$title', '$message');";
		$result = mysqli_query($con,$query);
		if(!$result) {
			//Insert something that would happen if the information was not placed in
			//the database correctly.
			echo '<script> parent.errorAlert("'. mysqli_error($con) .'", "https://140.209.47.120/genericresponses/EditResponses.php");</script>';
		} else {
			echo '<script> parent.successAlert("Your new reponse has been added.", "http://140.209.47.120/assistant.php"); </script>';
		}
	}
?>
</body>
</html>
