<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");
include($_SERVER['DOCUMENT_ROOT'] . "/calendar/CalendarFunctions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/includes/createHeader.php");
?>

<!DOCTYPE html>
<html>
<head>
    <?php reducedHeader() ?>
</head>

<body>

<?php
$positionName = $_POST['input-name'];
$semesterID = $_POST['select-semester'];
$positionID = $_POST['position'];

if (isset($_POST['create'])) {
    createPosition($positionName, $semesterID);
} else if (isset($_POST['modify'])) {
    updatePosition($positionName, $positionID);
} else if (isset($_POST['delete'])) {
    deletePosition($positionID);
}
?>

</body>
</html>
