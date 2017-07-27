<?php
include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php");
include($_SERVER["DOCUMENT_ROOT"] . "/calendar/CalendarFunctions.php");
include($_SERVER["DOCUMENT_ROOT"] . "/includes/meme.php");
include($_SERVER["DOCUMENT_ROOT"] . "/includes/createHeader.php");
?>

<?php
$userStatus = $_SESSION['admin_status'];
$semester = getActiveSemester();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calendar</title>
    <?php fullHeader(); ?>
    <link rel="stylesheet" href="../styles/calendar.css">
    <?php
    //test post please ignore
    if (!checkDateDood()) {
        randomMemesDood();
    }
    ?>
    <script src="../third-party-packages/jscolor-2.0.4/jscolor.js"></script>
    <script type="text/javascript" src="../third-party-packages/moment.js"></script>
    <script src="../js/CalendarScripts.js"></script>

    <style>
        <?php

        if($userStatus >= 2) {
            echo '
            #color-selector-button {
                border-bottom-left-radius: 0;
                border-top-left-radius: 0;
            }';
        }
        ?>
    </style>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>
<!-- Page content -->
<div id="page-content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-xs-12">
                <!-- The pills for selecting which day you want to be displayed -->
                <ul class="nav nav-pills days">
                    <li class="days"><a data-toggle="tab" href="#0">Sunday</a></li>
                    <li class="days"><a data-toggle="tab" href="#1">Monday</a></li>
                    <li class="days"><a data-toggle="tab" href="#2">Tuesday</a></li>
                    <li class="days"><a data-toggle="tab" href="#3">Wednesday</a></li>
                    <li class="days"><a data-toggle="tab" href="#4">Thursday</a></li>
                    <li class="days"><a data-toggle="tab" href="#5">Friday</a></li>
                    <li class="days"><a data-toggle="tab" href="#6">Saturday</a></li>
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
                <div class="btn-group">
                    <?php
                    if($userStatus >= 2) {
                        echo '<a href="CalendarIndexEdit.php" class="btn btn-custom" role="button">Edit</a>';
                    }
                    ?>

                    <?php
                    $sql = "SELECT `color`
                         FROM `users`
                         WHERE `username` LIKE '$username';";
                    $result = mysqli_query($con, $sql);
                    if (!$result) {
                        echo '<div class="alert alert-danger" role="alert"><strong>Oops!</strong> Something went wrong.<br>SQL Error: ';
                        echo mysqli_error($con);
                        echo '</div>';
                        $color = '#FFFFFF';
                    } else {
                        $ret = mysqli_fetch_assoc($result);
                        $color = $ret['color'];
                    }
                    ?>
                    <div class="btn-group">
                        <form id="colorForm" action="../settings/user/updateColor.php" method="post" target="formiFrame">
                            <input name="color" type="hidden" id="color_value" value="<?php echo $color; ?>"
                                   autocomplete="off" onchange="this.form.submit(); location.reload();">
                            <button id="color-selector-button" class="btn btn-custom jscolor {valueElement:'color_value'}">
                                Color Selector
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="tab-content">
                <!-- Makes sure that a semester has been set then calls the functions to generate the table for each day -->
                <!-- Each number passed to the function represents a day, starting with Sunday -->
                <?php
                if ($semester != 0) {
                    generateDayTable(0, false, $semester);
                    generateDayTable(1, false, $semester);
                    generateDayTable(2, false, $semester);
                    generateDayTable(3, false, $semester);
                    generateDayTable(4, false, $semester);
                    generateDayTable(5, false, $semester);
                    generateDayTable(6, false, $semester);
                }
                ?>
            </div>
        </div>
        <div class="row">
            <!-- Helper form for showStudentInfo.js -->
            <form id="helperForm" action="getStudentInfo.php" method="POST">
                <input id="helperInput" type="hidden" value="" name="student">
            </form>
            <div id="stuInfo">
                <div class="col-sm-3">
                    <img id="stuImg" style="height:200px; width:200px;" src="https://tdta.stthomas.edu/StudentRoster/StudentRosterImages/PlaceholderImg.png" />
                </div>
                <div class="col-sm-2">
                    <strong>Name: </strong><p id="stuName">N/A</p>
                    <strong>Username: </strong><p id="stuUsername">N/A</p>
                    <strong>Phone Number: </strong><p id="stuNumber">N/A</p>
                </div>
                <div id="testing"></div>
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
