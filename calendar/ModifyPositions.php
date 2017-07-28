<?php
    include $_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php";
    include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/SuperuserAuth.php");
    include($_SERVER["DOCUMENT_ROOT"] . "/includes/createHeader.php");
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
    <?php fullHeader(); ?>

    <link rel="stylesheet" href="../styles/calendar.css">
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
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
	include $_SERVER['DOCUMENT_ROOT'] . '/calendar/CalendarFunctions.php';

    $positions_array = getPositions();
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
		    <a class="btn btn-custom" id="return-button" href="https://tdta.stthomas.edu/calendar/CalendarIndexEdit.php"><span class="glyphicon glyphicon glyphicon-arrow-left"></span> Return</a>
		</div>

		<div class="col-md-10 text-left">
			<h1>Modify Positions</h1>
			<p>Add or remove a position that will be reflected in the calendar. <i>Note: positions can only be removed if there is no one assigned to it.</i></p>
			<br>
			<div class="row content">
				<div class="col-md-4 text-left">
					<form id="AddForm" method="post" action="modifyPosition.php" target="iFrame">
						<legend>Add Position</legend>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="input-name">Enter name:</label>
                                    <input class="form-control" name="input-name" autofocus required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
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
						<input id="submitbutton" type="submit" class="btn btn-custom btn-block" value="Create" name="create">
					</form>
				</div>

                <!-- Modify Positions -->
                <div class="col-md-4 text-left">
                    <form id="modifyForm" method="post" action="modifyPosition.php" target="iFrame">
                        <legend>Modify Position</legend>
                        <!-- Dropdown choose position -->
                        <div class="form-group">
                            <label for="modify-positions">Select position:</label>
                            <select id="modify-positions" class="form-control" name="position-id" required>
                                <?php
                                foreach ($positions_array as $positions_row) {
                                    echo '<option value="' . $positions_row['position_id'] . '">' . $positions_row['position_name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Input name -->
                        <div class="form-group">
                            <label for="modify-name">Edit name:</label>
                            <input id="modify-name" class="form-control" name="semester-name" required />
                        </div>
                        <input id="modify-semester-id" name="semester-id" type="hidden" />
                        <input id="submitbutton" type="submit" class="btn btn-custom btn-block" value="Modify" name="modify">
                    </form>
                </div>
				<div class="col-md-4 text-left">
					<form id="removeForm" method="post" action="modifyPosition.php" target="iFrame">
						<legend>Remove Position</legend>
						<div class="form-group">
							<label for ="position">Eligible Positions:</label>
							<select class="form-control" name="position" required>
								<option value="">----</option>
								<?php
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
