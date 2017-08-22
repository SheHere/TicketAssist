<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/SuperuserAuth.php");

include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
include($_SERVER['DOCUMENT_ROOT'] . '/includes/alerts.php');

include($_SERVER['DOCUMENT_ROOT'] . '/calendar/CalendarFunctions.php');
$semesters = getSemesters();
$timeStart = 7;
$timeEnd = 20;
$activeSemester = getActiveSemester();
$activeTimeStart = $semesters[$activeSemester]["time_start"];
$activeTimeEnd = $semesters[$activeSemester]["time_end"];
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Modify Semesters </title>
    <?php
    fullHeader();
    ?>

    <script type="text/javascript" src="../third-party-packages/moment.js"></script>
    <script type="text/javascript" src="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/src/js/bootstrap-datetimepicker.js"></script>

    <link rel="stylesheet" href="../styles/assistant.css">
    <link rel="stylesheet" href="../styles/calendar.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/Eonasdan/bootstrap-datetimepicker/e8bddc60e73c1ec2475f827be36e1957af72e2ea/build/css/bootstrap-datetimepicker.css">

    <style>
        #return-button {
            margin-top: 20px;
        }
    </style>

    <script>
        var info = [];

        $(document).ready(function() {
            $('#start-date').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('#end-date').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('#modify-start-date').datetimepicker({
                format: 'MM/DD/YYYY'
            });
            $('#modify-end-date').datetimepicker({
                format: 'MM/DD/YYYY'
            });

            buildInfo();
            updateFields(<?php echo getActiveSemester(); ?>)

            $('#modify-semesters').on('change', function() {
                updateFields(this.value.toString());
            })
        });

        function updateFields(id) {
            console.log(info[id]);
            $('#modify-start-date').data('DateTimePicker').date(info[id]['start-date']);
            $('#modify-end-date').data('DateTimePicker').date(info[id]['end-date']);
            $('#modify-name').val(info[id]['name']);
            $('#modify-semester-id').val(info[id]['id']);
            $('#modify-start-time').find(':selected')
                .val(info[id]['start-time'])
                .html(formatTime(info[id]['start-time']));
            $('#modify-end-time').find(':selected')
                .val(info[id]['end-time'])
                .html(formatTime(info[id]['end-time']));
        }

        function buildInfo() {
            <?php
            foreach ($semesters as $semester) {
                $dateStart = $semester['date_start'];
                $dateEnd = $semester['date_end'];

                echo "start_d = moment('$dateStart', 'MM/DD/YYYY').format('MM/DD/YYYY'); \r\n";
                echo "end_d = moment('$dateEnd', 'MM/DD/YYYY').format('MM/DD/YYYY'); \r\n";

                $semesterName = $semester['semester_name'];
                $semesterId = $semester['semester_id'];
                $semesterTimeStart = $semester['time_start'];
                $semesterTimeEnd = $semester['time_end'];
                echo "var name = '$semesterName'; \r\n";
                echo "var id = '$semesterId'; \r\n";
                echo "var start_t = $semesterTimeStart; \r\n";
                echo "var end_t = $semesterTimeEnd; \r\n";

                echo "info['$semesterId'] = {'id': id, 'name': name, 'start-date': start_d, 'end-date': end_d, 'start-time': start_t, 'end-time': end_t}; \r\n";
            }
            ?>
        }

        function formatTime(time) {
            var ret = '';
            if (time >= 12) {
                if (time > 12) {
                    ret += time - 12;
                } else {
                    ret += time;
                }
                ret += ':00 pm';
            } else {
                ret += time + ':00 am';
            }

            return ret;
        }
    </script>
</head>
<body>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
?>

<div class="container-fluid text-center">
    <div class="row content">
        <div class="col-md-1 text-left">
            <a class="btn btn-custom" id="return-button" href="https://tdta.stthomas.edu/calendar/CalendarIndexEdit.php"><span class="glyphicon glyphicon glyphicon-arrow-left"></span> Return</a>
        </div>

        <div class="col-md-10 text-left">
            <div class="row">
                <h1>Modify Semesters</h1>
                <p>Add or remove a semester that will be reflected in the calendar.</p>
                <br>
                <div class="row content">
                    <!-- Add Semesters -->
                    <div class="col-md-4 text-left">
                        <form id="add-form" method="post" action="modifySemester.php" target="iFrame">
                            <legend>Add Semester</legend>
                            <div class="form-group">
                                <!-- Input name -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="input-name">Enter name:</label>
                                        <input class="form-control" name="semester-name" autofocus required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Dropdown inherit positions -->
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="inherit-from">Inherit positions from:</label>
                                        <select id="inherit-from" class="form-control" name="inherit-from">
                                            <option value="0" selected>None</option>
                                            <?php
                                            foreach ($semesters as $semester) {
                                                echo '<option value="'.$semester['semester_id'].'">'.$semester['semester_name'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Input dates -->
                                <div class="row">
                                    <!-- Start date -->
                                    <div class="col-sm-6">
                                        <label for="start-date">Start date:</label>
                                        <div class="input-group date" id="start-date">
                                            <input name="start-date" class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- End date -->
                                    <div class="col-sm-6">
                                        <label for="end-date">End date:</label>
                                        <div class="input-group date" id="end-date">
                                            <input name="end-date" class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Dropdown start/end times -->
                                <div class="row">
                                    <!-- Start time -->
                                    <div class="col-sm-6">
                                        <label for="start-time">Start time:</label>
                                        <select id="start-time" name="start-time" class="form-control">
                                            <?php
                                            for ($i=$timeStart; $i <= $timeEnd ; $i++) {
                                                $timeDisplay = printTime($i);
                                                $selected = "";

                                                if ($i == $activeTimeStart) {
                                                    $selected = true;
                                                }

                                                echo "<option value=\"$i\" $selected>$timeDisplay</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- End time -->
                                    <div class="col-sm-6">
                                        <label for="end-time">End time:</label>
                                        <select id="end-time" name="end-time" class="form-control">
                                            <?php
                                            for ($i=$timeStart; $i <= $timeEnd ; $i++) {
                                                $timeDisplay = printTime($i);
                                                $selected = "";

                                                if ($i == $activeTimeEnd) {
                                                    $selected = true;
                                                }

                                                echo "<option value=\"$i\" $selected>$timeDisplay</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input id="submitbutton" style="margin-bottom: 20px;" type="submit" class="btn btn-custom btn-block" value="Create" name="create">
                        </form>
                    </div>

                    <!-- Modify Semesters -->
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
                            </div>
                            <div class="form-group">
                                <!-- Input name -->
                                <label for="modify-name">Edit name:</label>
                                <input id="modify-name" class="form-control" name="semester-name" required />
                            </div>
                            <div class="form-group">
                                <!-- Input dates -->
                                <div class="row">
                                    <!-- Start date -->
                                    <div class="col-sm-6">
                                        <label for="modify-start-date">Start date:</label>
                                        <div class="input-group date" id="modify-start-date" name="start-date">
                                            <input name="start-date" class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                    <!-- End date -->
                                    <div class="col-sm-6">
                                        <label for="modify-start-date">End date:</label>
                                        <div class="input-group date" id="modify-end-date" name="end-date">
                                            <input name="end-date" class="form-control" />
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- Dropdown start/end times -->
                                <div class="row">
                                    <!-- Start time -->
                                    <div class="col-sm-6">
                                        <label for="modify-start-time">Start time:</label>
                                        <select id="modify-start-time" name="start-time" class="form-control">
                                            <?php
                                            for ($i=$timeStart; $i <= $timeEnd ; $i++) {
                                                $timeDisplay = printTime($i);
                                                $selected = "";

                                                if ($i == $activeTimeStart) {
                                                    $selected = true;
                                                }

                                                echo "<option value=\"$i\" $selected>$timeDisplay</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- End time -->
                                    <div class="col-sm-6">
                                        <label for="modify-end-time">End time:</label>
                                        <select id="modify-end-time" name="end-time" class="form-control">
                                            <?php
                                            for ($i=$timeStart; $i <= $timeEnd ; $i++) {
                                                $timeDisplay = printTime($i);
                                                $selected = "";

                                                if ($i == $activeTimeEnd) {
                                                    $selected = true;
                                                }

                                                echo "<option value=\"$i\" $selected>$timeDisplay</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <input id="modify-semester-id" name="semester-id" type="hidden" />
                            <input id="submitbutton" type="submit" class="btn btn-custom btn-block" value="Modify" name="modify">
                        </form>
                    </div>

                    <!-- Delete Semesters -->
                    <div class="col-md-4 text-left">
                        <form id="removeForm" method="post" action="modifySemester.php" target="iFrame">
                            <legend>Remove Semester</legend>
                            <div class="form-group">
                                <label for="delete-semesters">Select semester:</label>
                                <select class="form-control" name="semester-id" required>
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
                            </div>
                            <input id="submitbutton" type="submit" class="btn btn-danger btn-block" value="Remove" name="delete">
                        </form>
                    </div>
                </div>
                <iframe name="iFrame" style="display: none;"></iframe>
            </div>
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
