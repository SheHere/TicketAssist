<?php
include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php");
include($_SERVER["DOCUMENT_ROOT"] . "/calendar/CalendarFunctions.php");
include($_SERVER["DOCUMENT_ROOT"] . "/includes/meme.php");
include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/SuperuserAuth.php");
include($_SERVER["DOCUMENT_ROOT"] . "/includes/createHeader.php");
?>

<?php
    if (isset($_GET['semester'])) {
        $semester = $_GET['semester'];
    } else {
        $semester = getActiveSemester();
    }

    $dateNum = date("w");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calendar</title>
    <?php fullHeader(); ?>

    <link rel="stylesheet" href="../third-party-packages/simple-sidebar/css/simple-sidebar.css">
    <link rel="stylesheet" href="../styles/calendar.css">
    <?php
    if (!checkDateDood()) {
        randomMemesDood();
    }
    ?>

    <script src="../third-party-packages/jscolor-2.0.4/jscolor.js"></script>
    <script type="text/javascript" src="../third-party-packages/moment.js"></script>
    <!-- Script to allow the sidebar to toggle -->
    <script type="text/javascript">
        $(document).ready(function () {
            $("#menu-toggle").click(function (e) {
                e.preventDefault();
                $("#wrapper").toggleClass("toggled");
                $("#menu-toggle-symbol").toggleClass("glyphicon-menu-right glyphicon-menu-left");
            });

            //Allows the buttons to toggle the sidebar
            $(".td-button").click(function() {
                document.getElementById("wrapper").className = "";
                document.getElementById("menu-toggle-symbol").className = "glyphicon glyphicon-menu-left";
                return true;
            });
        });
    </script>

    <style>
        #color-selector-button {
            border-bottom-left-radius: 0;
            border-top-left-radius: 0;
        }
    </style>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>
<div id="wrapper" class="toggled">
    <!-- Sidebar content -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav">
            <!-- Holds the iframe that will display information on a clicked cell -->
            <li><a href="<?php echo $_SERVER["SERVER_ROOT"] . '/calendar/ModifyPositions.php'; ?>">Edit positions</a></li>
            <li><a href="<?php echo $_SERVER["SERVER_ROOT"] . '/calendar/ModifySemesters.php'; ?>">Edit semesters</a></li>
            <li>
                <iframe name="sidebar-iframe" scrolling="no"></iframe>
            </li>
        </ul>
    </div>

    <!-- Page content -->
    <div id="page-content-wrapper">
        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">
            <span id="menu-toggle-symbol" class="glyphicon glyphicon-menu-right"></span>
        </a>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-xs-12">
                    <!-- The pills for selecting which day you want to be displayed -->
                    <ul class="nav nav-pills days">
                        <li class="days<?php if ($dateNum == 0) {echo " active";} ?>"><a data-toggle="tab" href="#0">Sunday</a></li>
                        <li class="days<?php if ($dateNum == 1) {echo " active";} ?>"><a data-toggle="tab" href="#1">Monday</a></li>
                        <li class="days<?php if ($dateNum == 2) {echo " active";} ?>"><a data-toggle="tab" href="#2">Tuesday</a></li>
                        <li class="days<?php if ($dateNum == 3) {echo " active";} ?>"><a data-toggle="tab" href="#3">Wednesday</a></li>
                        <li class="days<?php if ($dateNum == 4) {echo " active";} ?>"><a data-toggle="tab" href="#4">Thursday</a></li>
                        <li class="days<?php if ($dateNum == 5) {echo " active";} ?>"><a data-toggle="tab" href="#5">Friday</a></li>
                        <li class="days<?php if ($dateNum == 6) {echo " active";} ?>"><a data-toggle="tab" href="#6">Saturday</a></li>
                    </ul>
                </div>
                <div class="col-md-3 col-xs-12">
                    <?php
                    $semesterInfo = getSemesterInfo($semester);
                    $dateStart = $semesterInfo['date_start'];
                    $dateEnd = $semesterInfo['date_end'];
                    $semesterName = $semesterInfo['semester_name'];

                    echo "
                        <h4 id='semester-name-title'> 
                            <script>
                            var semesterName = '$semesterName';
                            
                            var formattedStartDate = moment('$dateStart', 'MM/DD/YYYY').format('MMM Do, YYYY');
                            var formattedEndDate = moment('$dateEnd', 'MM/DD/YYYY').format('MMM Do, YYYY');
                            
                            var ret = semesterName + ': ' + formattedStartDate + ' - ' + formattedEndDate;
                            
                            document.write(ret);
                            </script>
                        </h4>";
                    ?>
                </div>
                <div class="col-md-3 col-xs-12 text-right">

                    <form id="setActiveForm" action="setActiveSemester.php" method="post" target="formiFrame"></form>

                    <div class="btn-group">
                        <div class="btn-group">
                            <button class="btn btn-custom dropdown-toggle" type="button" data-toggle="dropdown">
                                Semester
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                <?php
                                $semesters_array = getSemesters();

                                foreach ($semesters_array as $semesters_row) {
                                    if (($semesters_row['active_status'] == 1) && ($semester == $semesters_row['semester_id'])) {
                                        echo '<li class="active"><a href="https://tdta.stthomas.edu/calendar/CalendarIndexEdit.php?semester='.$semesters_row['semester_id'].'"><span class="glyphicon glyphicon-ok"></span> ' . $semesters_row['semester_name'] . '</a></li>';
                                    } else if (($semesters_row['active_status'] == 1) && ($semester != $semesters_row['semester_id'])) {
                                        echo '<li><a href="https://tdta.stthomas.edu/calendar/CalendarIndexEdit.php?semester='.$semesters_row['semester_id'].'"><span class="glyphicon glyphicon-ok"></span> ' . $semesters_row['semester_name'] . '</a></li>';
                                    } else if (($semesters_row['active_status'] != 1) && ($semester == $semesters_row['semester_id'])) {
                                        echo '<li class="active"><a href="https://tdta.stthomas.edu/calendar/CalendarIndexEdit.php?semester='.$semesters_row['semester_id'].'">' . $semesters_row['semester_name'] . '</a></li>';
                                    } else {
                                        echo '<li><a href="https://tdta.stthomas.edu/calendar/CalendarIndexEdit.php?semester=' .$semesters_row['semester_id']. '">' . $semesters_row['semester_name'] . '</a></li>';
                                    }
                                }
                                ?>
                                <li role="seperator" class="divider"></li>
                                <input type="hidden" name="semesterID" form="setActiveForm" value="<?php echo $semester; ?>" />
                                <li><a href="javascript:{}" onclick="document.getElementById('setActiveForm').submit();" id="setActiveButton">Set as active</a></li>
                            </ul>
                        </div>
                        <a href="CalendarIndex.php" class="btn btn-custom">Done Editing</a>
                        <?php
                        $sql = "SELECT `color`
                                FROM `users`
                                WHERE `username` LIKE '$username';";
                        $result = mysqli_query($con, $sql);
                        if (!$result) {
                            echo '<div class="alert alert-danger" role="alert"><strong>Oops!</strong> Something went wrong.<br>SQL Error: ';
                            echo mysqli_error($con);
                            echo '</div>';
                            $color = "#FFFFFF";
                        } else {
                            $ret = mysqli_fetch_assoc($result);
                            $color = $ret['color'];
                        }
                        ?>
                        <div class="btn-group">
                            <form id="colorForm" action="../settings/user/updateColor.php" method="post" target="formiFrame">
                                <input name="color" type="hidden" id="color_value" value="<?php echo $color; ?>"
                                       autocomplete="off" onchange="this.form.submit(); location.reload();">
                                <button id="color-selector-button" class="btn btn-custom jscolor {valueElement:'color_value'}">Color Selector</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="tab-content">
                    <!-- Checks to make sure that a semester has been set then calls the functions to generate the table for each day -->
                    <!-- Each number passed to the function represents a day, starting with Sunday -->
                    <?php
                    if ($semester != 0) {
                        generateDayTable(0, true, $semester);
                        generateDayTable(1, true, $semester);
                        generateDayTable(2, true, $semester);
                        generateDayTable(3, true, $semester);
                        generateDayTable(4, true, $semester);
                        generateDayTable(5, true, $semester);
                        generateDayTable(6, true, $semester);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<iframe name="formiFrame" style="display: none;"></iframe>

<?php
include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
?>
</body>
</html>
