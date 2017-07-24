<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");
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

	$contactID = $_POST['contactID'];
	$fullname = $_POST['contactFullName'];
	$loc = $_POST['location'];
	$pos = $_POST['position'];
	$dnum = $_POST['dnumber'];
	$cnum  = $_POST['cnumber'];
	$grouping = $_POST['selectGrouping'];
	
	$query = "UPDATE `contactFTE` SET full_name = '$fullname', location = '$loc', position = '$pos', desk_number = '$dnum', cell_number = '$cnum', grouping = $grouping WHERE id = $contactID;";
	$result = mysqli_query($con,$query);
	if(!$result) {
		//Insert something that would happen if the information was not placed in
		//the database correctly.
		echo '<script>parent.errorAlert("'.mysqli_error($con).'","hhttps://tdta.stthomas.edu/settings/admin/EmployeeContactInfo.php");</script>';
		echo mysqli_error($con);
	} else {echo '<script>parent.successAlert("Personal Information successfully updated!","https://tdta.stthomas.edu/settings/admin/EmployeeContactInfo.php");</script>';}
?>

</body>
</html>