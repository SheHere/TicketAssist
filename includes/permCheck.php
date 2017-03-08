<?php 

function permissionCheck() {
	require('$_SERVER["DOCUMENT_ROOT"]' . '/loginutils/connectdb.php');
	
	$username = $_SESSION['username'];
	
	$sql = "SELECT admin_status
	FROM login
	WHERE username = '$username'";
	
	$result = mysqli_query($con, $sql);
	$usradmin = mysqli_fetch_assoc($result);
	$usrstatus = $usradmin['admin_status'];
	
	return $usrstatus;
}

?>