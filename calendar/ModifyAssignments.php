<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
  include($_SERVER['DOCUMENT_ROOT'] . '/calendar/CalendarFunctions.php');
	include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/SuperuserAuth.php");

  require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2017
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../styles/assistant.css">
<link rel="stylesheet" href="../styles/calendar.css">
<style>
	body {
		background-color: #510c76;
		margin-left: 10px;
		margin-right: 10px;
		color: white;
	}
</style>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="../js/jquery-3.1.1.min.js"></script>

</head>

<body>
	<hr>
	<?php
	$assignment = $_POST['assignment_id'];
	$position_id = $_POST['position_id'];
	$time_start = $_POST['time_start'];
	$semester = $_POST['semester_id'];

	$day = -1;
	if (isset($_POST['day'])) {
		$day = $_POST['day'];
	}

	// Checks if this page is being passed an active assignment or a blank assignment
	if (isset($_POST['assignment_id'])) {
		// If it is, grab all information from the server relevent to that assignment
		// i.e. the position, the user, and the assignment
		$query = "SELECT *
							FROM  `calendar_positions` cp JOIN `calendar_assignments` ca
								ON cp.position_id = ca.position_id
							JOIN `users` u
								ON ca.username = u.username
							WHERE ca.assignment_id=".$assignment.";";
	} else {
		// If it is not, only pull information from the server regarding the position
		// This is because the only thing that we cant get from the index page is the name of position being clicked on
		$query = "SELECT *
							FROM `calendar_positions`
							WHERE `position_id`=".$position_id.";";
	}

	// Executing the call to the server and storing the result
	$result = mysqli_query($con,$query);
	if(!$result) {
		echo 'ERROR: Could not retrieve user. ' . mysqli_error($con);
	} else {
		$row = mysqli_fetch_assoc($result);
	}
	?>

	<!-- Begin building the form using the information obtained above -->
	<form action="updateAssignment.php" target="temp-target-iframe" method="post">

		<div class="form-group">
			<label for ="username">Select Student:</label>
			<select class="form-control" name="username" required>
				<!-- Sets the first option in the Select Student list to the name of the person clicked on
				<--  If no name is avaliable, the username will be used
				<--  If no user was pulled from the database, this will stay blank -->
				<option value="<?php echo $row['username']; ?>">
					<?php
						if ($row['fname'] == "" || $row['lname'] == "") {
							echo $row['username'];
						} else {
							echo $row['lname'].", ".$row['fname'];
						}
					?>
				</option>
				<!-- Calls the function that will populate the rest of the list of possible students -->
				<?php printStudents(); ?>
			</select>
		</div>

		<div class="form-group">
			<label for ="position">Select Position:</label>
			<select class="form-control" name="position_id" required>
				<!-- Same idea as what was done previously with the username, but with the positions this time
				<--  There will never not be a position_id that reaches this point, either from the database or the POST -->
				<option value="<?php echo $row['position_id']; ?>">
					<?php	echo $row['position_name']; ?>
				</option>
				<!-- Calls the function that will populate the list of possible positions -->
				<?php printPositions(); ?>
			</select>
		</div>

		<div class="form-group">
			<label for="time_start">Start Time:</label>
			<select class="form-control" name="time_start" required>
				<!-- Same process as with the position, but this time with the start time -->
				<option value=
				<?php
					// Checks to see if the time is avaliable in the information we pulled from the database
					// If there was no time that was given from the database (i.e. if a black cell was clicked on),
					// The time from the POST will be used
					if ($row['time_start'] == "") {
						echo $time_start;
					} else {
						echo $row['time_start'];
					}
				?>
				 selected>
				<?php
					// Same process as setting the value for the time_start,
					// but this time we print the time to be displayed nicely
					if ($row['time_start'] == "") {
						echo printTime($time_start);
					} else {
						echo printTime($row['time_start']);
					}
				?>
				</option>
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
			<label for="time_end">End Time:</label>
			<select class="form-control" name="time_end" required>
				<option value=
					<?php
						// Almost everything is the same here as it is with the time_start
						// This will never take anything from POST, so if no time is pulled from the database the value will be set to 0
						if ($row['time_end'] == "") {
							echo 0;
						} else {
							echo $row['time_end'];
						}
					?>
					 selected>
					<?php
						// Displays the end time nicely
						// If no time_end was pulled from the database, nothing will be printed
						if ($row['time_end'] == "") {
							echo "";
						} else {
							echo printTime($row['time_end']);
						}
					?>
				</option>
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

		<table id="day-table">
			<tr>
				<!-- Checks to see if the day string pulled from the database contains the letter pertaining to the day
				<--  Also, if a value was instead provided by POST, it checks what day was provided
				<--  This is all held in a table for formatting purposes -->
				<td><input type="checkbox" name="day0" value="U" <?php if ((strpos($row['day'], 'U') !== false) || $day == 0) {echo "checked";}; ?>></td>
				<td><input type="checkbox" name="day1" value="M" <?php if ((strpos($row['day'], 'M') !== false) || $day == 1) {echo "checked";}; ?>></td>
				<td><input type="checkbox" name="day2" value="T" <?php if ((strpos($row['day'], 'T') !== false) || $day == 2) {echo "checked";}; ?>></td>
				<td><input type="checkbox" name="day3" value="W" <?php if ((strpos($row['day'], 'W') !== false) || $day == 3) {echo "checked";}; ?>></td>
				<td><input type="checkbox" name="day4" value="R" <?php if ((strpos($row['day'], 'R') !== false) || $day == 4) {echo "checked";}; ?>></td>
				<td><input type="checkbox" name="day5" value="F" <?php if ((strpos($row['day'], 'F') !== false) || $day == 5) {echo "checked";}; ?>></td>
				<td><input type="checkbox" name="day6" value="S" <?php if ((strpos($row['day'], 'S') !== false) || $day == 6) {echo "checked";}; ?>></td>
			</tr>
			<tr>
				<td><label for="day0">SU</label></td>
				<td><label for="day1">M</label></td>
				<td><label for="day2">TU</label></td>
				<td><label for="day3">W</label></td>
				<td><label for="day4">TH</label></td>
				<td><label for="day5">F</label></td>
				<td><label for="day6">SA</label></td>
			</tr>
		</table>

		<!-- The assignment_id hidden input acts as a way to pass the assignment_id to the next page along with the rest of the information
		<--  This is only used if an assignment_id was provided to begin with -->
		<input type="hidden" name="assignment_id" value="<?php echo $assignment; ?>" />
        <input type="hidden" name="semester_id" value="<?php echo $semester; ?>" />
		<hr>
		<button type="submit" class="btn btn-primary btn-block" value="confirm" name="confirm_button">Confirm Changes</button>
		<button type="submit" class="btn btn-danger btn-block" value="delete" name="delete_button">Delete Assignment</button>
	</form>
	<!-- Testing iframe, accepts the form  -->
	<iframe name="temp-target-iframe" scrolling="no" style="display: none;"></iframe>
</body>
</html>
