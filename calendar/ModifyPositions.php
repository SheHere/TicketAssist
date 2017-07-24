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
		    <a role="button" class="btn btn-custom" id="return-button" href="https://tdta.stthomas.edu/calendar/CalendarIndexEdit.php"><span class="glyphicon glyphicon glyphicon-arrow-left" aria-hidden="true"></span> Return</a>
		</div>

		<div class="col-md-10 text-left">
			<h1>Modify Positions</h1>
			<p>Add or remove a position that will be reflected in the calendar. <i>Note: positions can only be removed if there is no one assigned to it.</i></p>
			<br>
			<div class="row content">
				<div class="col-md-4 text-left">
					<form id="AddForm" method="post" action="modifyPosition.php" target="iFrame">
						<legend>Add Position</legend>
						<div class="form-group">
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="input-name">Enter name:</label>
                                    <input type="text" class="form-control" name="input-name" autofocus required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="select-semester">Select semester:</label>
                                    <select class="form-control" name="select-semester" required>
                                        <?php
                                        $semesters_array = getSemesters();

                                        foreach ($semesters_array as $semesters_row) {
                                            echo '<option value="' .$semesters_row['semester_id']. '">' .$semesters_row['semester_name']. '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
						</div>
						<input id="submitbutton" style="margin-bottom: 20px;" type="submit" class="btn btn-custom btn-block" value="Create" name="create">
					</form>
				</div>

                <!-- Modify Positions -->
                <div class="col-md-4 text-left">
                    <form id="modifyForm" method="post" action="modifySemester.php" target="iFrame">
                        <legend>Modify Semester</legend>
                        <div class="form-group">
                            <!-- Dropdown choose semester -->
                            <label for="modify-semesters">Select semester:</label>
                            <select id="modify-semesters" class="form-control" name="semester-id" required>
                                <?php
                                foreach ($semesters as $semester) {
                                    $selected = "";
                                    if ($semester['active_status'] == 1) {
                                        $selected = "selected";
                                    }

                                    echo '<option value="'.$semester['semester_id'].'" '.$selected.'>'.$semester['semester_name'].'</option>';
                                }
                                ?>
                            </select>
                            <!-- Input name -->
                            <div class="add-top-margin">
                                <label for="modify-name">Edit name:</label>
                                <input id="modify-name" type="text" class="form-control" name="semester-name" required />
                            </div>
                            <!-- Input dates -->
                            <div class="row add-top-margin">
                                <!-- Start date -->
                                <div class="col-sm-6">
                                    <label for="modify-start-date">Start date:</label>
                                    <div class="input-group date" id="modify-start-date" name="start-date">
                                        <input name="start-date" type="text" class="form-control" />
                                        <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                                <!-- End date -->
                                <div class="col-sm-6">
                                    <label for="modify-start-date">Start date:</label>
                                    <div class="input-group date" id="modify-end-date" name="end-date">
                                        <input name="end-date" type="text" class="form-control" />
                                        <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input id="modify-semester-id" name="semester-id" type="hidden" />
                        <input id="submitbutton" type="submit" class="btn btn-custom btn-block" value="Modify" name="modify">
                    </form>
                </div>
				<div class="col-md-4 text-left">
					<form id="removeForm" method="post" action="modifyPosition.php" target="iFrame">
						<legend>Remove Position</legend>
						<div class="form-group">
							<label for ="position-dropdown">Eligible Positions:</label>
							<select class="form-control" name="position-dropdown" required>
								<option value="">----</option>
								<?php
                                $positions_array = getPositions();
                                
                                foreach ($positions_array as $positions_row) {
                                    echo '<option value="' . $positions_row['position_id'] . '">' . $positions_row['position_name'] . '</option>';
                                }
                                ?>
							</select>
						</div>
						<input id="submitbutton" type="submit" class="btn btn-danger btn-block" value="Remove" name="delete">
					</form>
				</div>
			</div>

			<iframe name="iFrame" style="display: none;"></iframe>
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
