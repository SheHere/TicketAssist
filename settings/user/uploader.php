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
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");

if(isset($_FILES['uploadedfile'])) {

	//BEGIN UPLOAD OF FILE =============================

	// Where the file is going to be placed
	$target_path = $_SERVER['DOCUMENT_ROOT'] . "/StudentRoster/StudentRosterImages/";

	$uploaded_file_info = pathinfo($_FILES['uploadedfile']['name']);
	$username = $_SESSION['username'];

	/* Add the original filename to our target path.
	Result is "/StudentRoster/StudentRosterImages/username.extension" */
	$target_path .= $username . "." . $uploaded_file_info['extension'];
	$errormsg = '<div class="alert alert-warning" role="alert"><strong>Oops! </strong>';
	$successmsg = '';

	if (strcasecmp($uploaded_file_info['extension'], "jpeg") || strcasecmp($uploaded_file_info['extension'], "jpg")) {
		//Checks if the file exists
		if (!file_exists($target_path)) {
			//Attempts to move the file
			if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
			    $successmsg .= "File uploaded." . "<br>";
			} else{
			    echo $errormsg . "File upload failed.</div>";
			}
		} else {
			//Attempts to delete the file and re-add it
			if (unlink($target_path)) {
				$successmsg .= "File removed." . "<br>";
				if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
					echo $successmsg . "File readded." . "<br>";
				} else {
					echo $errormsg . "File readdition failed. (" . $target_path . ")</div>";
				}
			} else {
				echo $errormsg . "File removal failed. (" . $target_path . ")</div>";
			}
		}
	} else {
		$errormsg .= "Incorrect file type.<br>";
	}

	//BEGIN ADDITION OF PATH TO DATABASE ==============================

	$query = "UPDATE `users` SET `img_path` = 'StudentRosterImages/" . $username . "." . $uploaded_file_info['extension'] . "'  WHERE `username` = '$username';";

	$result = mysqli_query($con,$query);

	if(!$result) {
		echo $errormsg . 'SQL error: ';
		echo mysqli_error($con);
		echo '</div>';
	} else {
		echo '<script>parent.successAlert("Bio Picture successfully updated!","https://140.209.47.120/StudentRoster/studentbios.php");</script>';
	}
} else {
	echo '<script>parent.successAlert("No file found. '.$errormsg.'","https://140.209.47.120/settings/user/UserSettings.php");</script>';
}

?>


</body>
</html>
