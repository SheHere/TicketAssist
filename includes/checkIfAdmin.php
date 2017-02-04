<?php 
	require('../loginutils/connectdb.php');

	$username = $_SESSION['username'];
	$output = "";

	$sql = "SELECT admin_status FROM logs WHERE username = '$username'";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		$row = mysqli_fetch_assoc($result))
		if($row['admin_status'] <= 2){
			exit("Error.");
		}
	}
?>