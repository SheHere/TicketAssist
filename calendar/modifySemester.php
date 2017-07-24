<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");
include($_SERVER['DOCUMENT_ROOT'] . "/calendar/CalendarFunctions.php");
include($_SERVER['DOCUMENT_ROOT'] . "/includes/createHeader.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html>
<head>
    <?php reducedHeader() ?>
</head>

<body>

<?php

$semesterID = $_POST['semester-id'];
$inheritFrom = $_POST['inherit-from'];
$semesterName = $_POST['semester-name'];
$startDate = $_POST['start-date'];
$endDate = $_POST['end-date'];
$startTime = $_POST['start-time'];
$endTime = $_POST['end-time'];
$activeStatus = 0;

if (isset($_POST['create'])) {
    if(!($inheritFrom == 0)) {
        createSemester($semesterName, $startDate, $endDate, $activeStatus, $startTime, $endTime, $inheritFrom);
    } else {
        createSemester($semesterName, $startDate, $endDate, $activeStatus, $startTime, $endTime);
    }
} else if (isset($_POST['modify'])) {
    updateSemester($semesterID, $semesterName, $startDate, $endDate, $startTime, $endTime);
} else if (isset($_POST['delete'])) {
    deleteSemester($semesterID);
}

?>

</body>
</html>
