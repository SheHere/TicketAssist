<?php
  include $_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php";
  include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/SuperuserAuth.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Modify Positions </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../styles/assistant.css">
  <link rel="stylesheet" href="../styles/calendar.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <?php
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/alerts.php';
  ?>

  <style>
    #return-button {
      margin-top: 20px;
    }
  </style>
</head>
<body>

<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
	include $_SERVER['DOCUMENT_ROOT'] . '/calendar/CalendarFunctions.php';
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
		    <a role="button" class="btn btn-custom" id="return-button" href="https://140.209.47.120/calendar/CalendarIndex.php"><span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Return</a>
		</div>

		<div class="col-md-10 text-left">
			<h1>Modify Positions</h1>
			<p>Add or remove a position that will be reflected in the calendar. <i>Note: positions can only be removed if there is no one assigned to it.</i></p>
			<br>
			<div class="row content">
				<div class="col-md-6 text-left">
					<form id="AddForm" method="post" action="addPosition.php" target="iFrame">
						<legend>Add Position</legend>
						<div class="form-group">
							<label for ="newPosition">New Position:</label>
							<input type="text" class="form-control" name="newPosition" autofocus required>
						</div>
						<input id="submitbutton" style="margin-bottom: 20px;" type="submit" class="btn btn-custom btn-block" value="Create">
					</form>
				</div>

				<div class="col-md-6 text-left">
					<form id="removeForm" method="post" action="deletePosition.php" target="iFrame">
						<legend>Remove Position</legend>
						<div class="form-group">
							<label for ="delPosition">Eligible Positions:</label>
							<select class="form-control" name="delPosition" required>
								<option value="">----</option>
								<?php removablePositions(); ?>
							</select>
						</div>
						<input id="submitbutton" type="submit" class="btn btn-danger btn-block" value="Remove">
					</form>
				</div>



			</div>
			<iframe name="iFrame" width="100%" height="257px" frameBorder="0" marginwidth="0px" style="display: block;"></iframe>
		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
?>

</body>
</html>
