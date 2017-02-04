<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");
	include $_SERVER['DOCUMENT_ROOT'] . '/calendar/CalendarFunctions.php';
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../styles/assistant.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/alerts.js"></script>
</head>

<body>

<?php
	$newPos = $_POST['newPosition'];
	createPosition($newPos);
?>

</body>
</html>
