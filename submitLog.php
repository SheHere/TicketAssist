<?php include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php"); ?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<style>
body {
	margin-left: 0px;
	margin-right: 0px;
}
</style>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/jquery-3.1.1.min.js"></script>
</head>

<body>



<?php
	require('loginutils/connectdb.php');
	
	//Get the username of the person currently logged in.
	$username = $_SESSION['username'];
	$output = nl2br(htmlentities($_POST['message'], ENT_QUOTES, 'UTF-8'));
	//Create query to insert into database.
	$query = "INSERT INTO `logs` (id, username, log_text, date) VALUES (NULL, '$username', '$output', CURRENT_TIMESTAMP)";
	
	//Check the result of adding it to the database.
	$result = mysqli_query($con,$query);
	
	//Displays any errors
	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo 'ERROR: Log not created';
		echo mysqli_error($con);
	}
?>


</body>
	<script>
		parent.parent.document.getElementById("logiFrame").contentWindow.location.reload(true);
		parent.parent.myFunction();
	</script>
</html>