<?php
	require('loginutils/connectdb.php');
	
	$query = "INSERT INTO `test` (`test`, `text`, `date_created`) VALUES (NULL, '8:00 - created 12/2', NULL);";
	$result = mysqli_query($con,$query);
	
?>