 <?php
  include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php");
  include($_SERVER["DOCUMENT_ROOT"] . "/calendar/CalendarFunctions.php");
  include($_SERVER["DOCUMENT_ROOT"] . "/includes/meme.php");
  include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/SuperuserAuth.php");
  include($_SERVER["DOCUMENT_ROOT"] . "/includes/createHeader.php");
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
  <script src="../../third-party-packages/jscolor-2.0.4/jscolor.js"></script>
</head>
<body>
  <?php
  	include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
  ?>
  <!-- Page content -->
  <div id="page-content-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
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
        <div class="col-md-6 text-right">
          <?php
            
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
            } else {
              $ret = mysqli_fetch_assoc($result);
              $color = $ret['color'];
            }
          ?>
          <form id="colorForm" action="../settings/user/updateColor.php" method="post" target="iFrame3">
            <input name="color" type="hidden" id="color_value" value="<?php echo $color; ?>" autocomplete="off" onchange="this.form.submit(); location.reload();">
            <button class="btn btn-custom jscolor {valueElement:'color_value'}" style="border: solid 1px">Color Selector</button>
          </form>
          <iframe name="iFrame3" style="display: none;"></iframe>
        </div>
      </div>
      <div class="row">
        <div class="tab-content">
          <!-- Calls the functions to generate the table for each day -->
          <!-- Each number passed to the function represents a day, starting with Sunday -->
          <?php generateDayTable(0, false, 7, 20); ?>
          <?php generateDayTable(1, false, 7, 20); ?>
          <?php generateDayTable(2, false, 7, 20); ?>
          <?php generateDayTable(3, false, 7, 20); ?>
          <?php generateDayTable(4, false, 7, 20); ?>
          <?php generateDayTable(5, false, 7, 20); ?>
          <?php generateDayTable(6, false, 7, 20); ?>
        </div>
      </div>
    </div>
  </div>

  <?php
    include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
  ?>
</body>
</html>
