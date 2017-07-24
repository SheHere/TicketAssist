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
// If contact is less than 0, then a new contact is being created.
// If grouping is set to "Remove Contact (value = -2), delete the entry
// If neither of those, then the contact is being edited
if($contactID > 0){
	$query = "UPDATE `contactFTE` SET full_name = '$fullname', location = '$loc', position = '$pos', desk_number = '$dnum', cell_number = '$cnum', grouping = $grouping WHERE id = $contactID;";
}else if($grouping < 0) {
	$query = "DELETE FROM `contactFTE` WHERE `contactFTE`.`id` = $contactID;";
}else{
	$query = "INSERT INTO `contactFTE` (`id`, `full_name`, `location`, `position`, `desk_number`, `cell_number`, `grouping`) VALUES (NULL, '$fullname', '$loc', '$pos', '$dnum', '$cnum', $grouping); ";
}

$result = mysqli_query($con,$query);
if(!$result) {
    //Insert something that would happen if the information was not placed in
    //the database correctly.
    echo '<script>parent.errorAlert("'.mysqli_error($con).'","https://tdta.stthomas.edu/contacts/ContactInfoFullView.php");</script>';
    echo mysqli_error($con);
} else {echo '<script>parent.successAlert("Contact successfully updated!","https://tdta.stthomas.edu/contacts/ContactInfoFullView.php");</script>';}
?>

</body>
</html>