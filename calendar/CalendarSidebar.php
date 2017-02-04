<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
	include($_SERVER["DOCUMENT_ROOT"] . "/calendar/CalendarFunctions.php");
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
<style>
body {
	padding-right: 5px;
	background-color: #510c76;
	color: white;
}
h2 {
	margin: 0px;
	padding: 0px;
}
</style>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../js/jquery-3.1.1.min.js"></script>
</head>
<body>
	<h3>Edit Shift</h3>
	<div class="form-group">
		<label for ="user_to_add">Select Student:</label>
		<select class="form-control" name="user_to_add">
			<option value="">----</option>
			<?php allStudents(); ?>
		</select>
	</div>
	<div class="form-group">
		<label for ="position">Select Position:</label>
		<select class="form-control" name="position">
			<option value="">----</option>
			<?php allPositions(); ?>
		</select>
	</div>
	<div class="form-group">
		<label for="startTime">Start Time:</label>
		<select class="form-control" name="startTime">
			<option value="" selected>----</option>
			<option value="7">7:00 am</option>
			<option value="8">8:00 am</option>
			<option value="9">9:00 am</option>
			<option value="10">10:00 am</option>
			<option value="11">11:00 am</option>
			<option value="12">12:00 pm</option>
			<option value="13">1:00 pm</option>
			<option value="14">2:00 pm</option>
			<option value="15">3:00 pm</option>
			<option value="16">4:00 pm</option>
			<option value="17">5:00 pm</option>
			<option value="18">6:00 pm</option>
			<option value="19">7:00 pm</option>
			<option value="20">8:00 pm</option>
		</select>
	</div>
	<div class="form-group">
		<label for="endTime">End Time:</label>
		<select class="form-control" name="endTime">
			<option value="" selected>----</option>
			<option value="7">7:00 am</option>
			<option value="8">8:00 am</option>
			<option value="9">9:00 am</option>
			<option value="10">10:00 am</option>
			<option value="11">11:00 am</option>
			<option value="12">12:00 pm</option>
			<option value="13">1:00 pm</option>
			<option value="14">2:00 pm</option>
			<option value="15">3:00 pm</option>
			<option value="16">4:00 pm</option>
			<option value="17">5:00 pm</option>
			<option value="18">6:00 pm</option>
			<option value="19">7:00 pm</option>
			<option value="20">8:00 pm</option>
		</select>
	</div>
	
</body>
</html>
