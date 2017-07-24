<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/loginutils/auth.php');
	include($_SERVER['DOCUMENT_ROOT'] . '/loginutils/SuperuserAuth.php');
  include($_SERVER['DOCUMENT_ROOT'] . '/calendar/CalendarFunctions.php');
  include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html>
<head>
  <?php reducedHeader(); ?>
</head>

<body>
  <?php
    $assignment_id = $_POST['assignment_id'];
    $username = $_POST['username'];
  	$position_id = $_POST['position_id'];
  	$time_start = $_POST['time_start'];
  	$time_end = $_POST['time_end'];
  	$semester = $_POST['semester_id'];
    $day0 = $_POST['day0'];
    $day1 = $_POST['day1'];
    $day2 = $_POST['day2'];
    $day3 = $_POST['day3'];
    $day4 = $_POST['day4'];
    $day5 = $_POST['day5'];
    $day6 = $_POST['day6'];

    $day_string = $day0 . $day1 . $day2 . $day3 . $day4 . $day5 . $day6;

    if (isset($_POST['delete_button'])) {
      deleteAssignment($assignment_id);
    } else if (isset($_POST['confirm_button'])) {
      if ($time_end <= $time_start) {
        echo '<script>parent.parent.errorAlert("Please select an end time after the beginning time."); </script>';
			} else if (checkForTimeOverlap($assignment_id, $time_start, $time_end, $position_id, $day_string)) {
				echo '<script>parent.parent.errorAlert("Error: Time overlaps preexisting shift(s)"); </script>';
			} else if ($assignment_id == "") {
				createAssignment($time_start, $time_end, $day_string, $position_id, $username, $semester);
			} else {
				updateAssignment($assignment_id, $time_start, $time_end, $day_string, $position_id, $username, $semester);
      }
    }
  ?>
</body>
</html>
