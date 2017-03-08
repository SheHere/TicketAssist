<?php

  function generateDayTable($day, $edit, $opening_time, $closing_time) {
    $localtime = localtime(time(), true);

    require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

    //Establishes that this will be a tab-pane with the id set to the name
    //provided to the function
    echo '<div id="'.$day.'" class="tab-pane fade in';

    // Sets the current day to the active tab
    if ($localtime["tm_wday"] == $day) {
      echo ' active"';
    } else {
      echo '"';
    }

    // Begins the table
    echo '>
      <table class="table-bordered">
        <thead>
          <tr>
            <th>';
    if ($day == 0) { echo "SUN"; }
    else if ($day == 1) { echo "MON"; }
    else if ($day == 2) { echo "TUE"; }
    else if ($day == 3) { echo "WED"; }
    else if ($day == 4) { echo "THU"; }
    else if ($day == 5) { echo "FRI"; }
    else if ($day == 6) { echo "SAT"; }
    echo '</th>';

    // Pulls all positions from the database
    $positions_sql = "SELECT *
                      FROM calendar_positions
                      ORDER BY `position_name` ASC";
    $positions_result = mysqli_query($con, $positions_sql);

    if(!$positions_result) {
      echo 'ERROR: Could not retrieve positions. ' . mysqli_error($con);
    } else {
      // Assign the results to an array to be used later
      $positions_array = array();
      while ($positions_row = mysqli_fetch_array($positions_result, MYSQLI_ASSOC)) {
        $positions_array[] = $positions_row;
      }
    }

    // Makes sure there are positions created, then loops through them,
    // creating a new table head for every position
    if (sizeof($positions_array) > 0) {
      foreach($positions_array as $positions_row) {
        echo '<th>'.$positions_row['position_name'].'</th>
        ';
      }
    } else {
      echo 'ERROR: No positions found.';
    }

    // Completes the table head and begins the table body
    echo '</tr>
      </thead>
      <tbody>
        ';

    //Pulls all users and their color that currently have an assignment
    $assignments_sql = "SELECT *
                    FROM `calendar_assignments` LEFT JOIN `users`
                    ON `calendar_assignments`.`username` = `users`.`username`;";
    $assignments_result = mysqli_query($con, $assignments_sql);
    if(!$assignments_result) {
      echo 'ERROR: Could not retrieve assignments. ' . mysqli_error($con);
    } else {
      // Assign the results to an array to be used later
      $assignments_array = array();
      while ($assignments_row = mysqli_fetch_array($assignments_result, MYSQLI_ASSOC)) {
        $assignments_array[] = $assignments_row;
      }
    }

    // Loop through the time that the Tech Desk is open
    for ($i=$opening_time; $i<$closing_time; $i++) {
      // Set the first cell of the current row to the correct time
      echo '<tr>
              <td><div class="time-container">'.printDuration($i, $i+1).'</div></td>';

      // Loops through all positions
      foreach($positions_array as $positions_row) {
        // At each position, loops through all assignments
        foreach($assignments_array as $assignments_row) {
          $created_cell = false;

          $daycomp = false;
          if ($day == 0) {
            if (strpos($assignments_row['day'], 'U') !== false) {
              $daycomp = true;
            }
          } else if ($day == 1) {
            if (strpos($assignments_row['day'], 'M') !== false) {
              $daycomp = true;
            }
          } else if ($day == 2) {
            if (strpos($assignments_row['day'], 'T') !== false) {
              $daycomp = true;
            }
          } else if ($day == 3) {
            if (strpos($assignments_row['day'], 'W') !== false) {
              $daycomp = true;
            }
          } else if ($day == 4) {
            if (strpos($assignments_row['day'], 'R') !== false) {
              $daycomp = true;
            }
          } else if ($day == 5) {
            if (strpos($assignments_row['day'], 'F') !== false) {
              $daycomp = true;
            }
          } else if ($day == 6) {
            if (strpos($assignments_row['day'], 'S') !== false) {
              $daycomp = true;
            }
          }

          // Checks if the position and assignment are the same
          if (($assignments_row['position_id'] == $positions_row['position_id'])
            && ($daycomp)
            && ($assignments_row['time_start'] <= $i)
            && ($assignments_row['time_end'] >= ($i+1))) {

            //break up the color in its RGB components
            $r = hexdec(substr($assignments_row['color'],0,2));
            $g = hexdec(substr($assignments_row['color'],2,2));
            $b = hexdec(substr($assignments_row['color'],4,2));

            //do weighted avarage
            if ($r + $g + $b > 382) {
              echo '<td style="background-color:#'.$assignments_row['color'].'; color:black;">';
            } else {
              echo '<td style="background-color:#'.$assignments_row['color'].'; color:white;">';
            }

            if ($edit) {
              echo '<form target="sidebar-iframe" action="ModifyAssignments.php" method="post">
                      <input type="hidden" name="assignment_id" value="'.$assignments_row['assignment_id'].'"></input>
                      <button style="background-color: transparent;" type="submit" class="btn td-button">';

              if ($assignments_row['fname'] == "" || $assignments_row['lname'] == "") {
                echo $assignments_row['username'];
              } else {
                echo $assignments_row['lname'].', '.$assignments_row['fname'];
              }

              echo '</button>
                  </form>';

            } else {
              echo '<div class="td-button">';
              if ($assignments_row['fname'] == "" || $assignments_row['lname'] == "") {
                echo $assignments_row['username'];
              } else {
                echo $assignments_row['lname'].', '.$assignments_row['fname'];
              }
              echo '</div>';
            }

            echo '</td>';

            $created_cell = true;

            break;
          }
        }
        if (!$created_cell) {
          if ($edit) {
            echo '
                <td>
                  <form target="sidebar-iframe" action="ModifyAssignments.php" method="post">
                    <button style="background-color: transparent;" type="submit" class="btn td-button">&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</button>
                    <input type="hidden" name="position_id" value="'.$positions_row['position_id'].'"></input>
                    <input type="hidden" name="time_start" value="'.$i.'"></input>
                    <input type="hidden" name="day" value="'.$day.'"></input>
                  </form>
                </td>
            ';
          } else {
            echo '<td></td>';
          }
        }
      }
    } //End for loop

    echo '</tbody>
        </table>
      </div>';
  }

  function createPosition($position_name) {
    require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
    $create_pos_query = "INSERT INTO `calendar_positions` (position_id, position_name)
                      		VALUES (NULL, '$position_name');";
	   $create_pos_result = mysqli_query($con,$create_pos_query);
    //The following alerts rely on /includes/alerts.php being included on the page. If called in an iFrame, change to parent.___Alert
    if(!$create_pos_result){
    	//If the query was not executed, give an error alert with the mysql error as the message
    	echo '<script> parent.errorAlert("'. mysqli_error($con) .'", "http://140.209.47.120/calendar/ModifyPositions.php");</script>';
    }else{
    	//If the position is created, give a success alert.
    	echo '<script> parent.successAlert("Position successfully created!", "http://140.209.47.120/calendar/CalendarIndexEdit.php");</script>';
    }
  }

  function removablePositions(){
  	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
  	$rem_query = "
  		SELECT *
  		FROM calendar_positions
  		WHERE position_id NOT IN (SELECT position_id FROM calendar_assignments);";
  	$rem_result = mysqli_query($con,$rem_query);
  	if(mysqli_num_rows($rem_result) > 0){
  		$toEcho = '';
  		while($row = mysqli_fetch_assoc($rem_result)){
  			$toEcho .= '<option value="'.$row['position_id'].'">'.$row['position_name'].'</option>
  			';
  		}
  		echo $toEcho;
  	}
  }

  function removePosition($position_id) {
  	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
  	//This query selects all positions that do not have users assigned to them.
  	$remove_pos_query = "
  		DELETE FROM `calendar_positions`
  		WHERE `calendar_positions`.`position_id` = $position_id
  		";
  	$remove_pos_result = mysqli_query($con,$remove_pos_query);
  	if(!$remove_pos_result){
  		//If the query was not executed, give an error alert with the mysql error as the message
  		echo '<script> parent.errorAlert("'. mysqli_error($con) .'", "http://140.209.47.120/calendar/ModifyPositions.php");</script>';
  	}else{
  		//If the position is created, give a success alert.
  		echo '<script> parent.successAlert("Position successfully deleted!", "http://140.209.47.120/calendar/ModifyPositions.php");</script>';
  	}
  }

  function createAssignment($time_start, $time_end, $day, $position_id, $username) {
  	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
  	$create_assig_query = "INSERT INTO `calendar_assignments` (`time_start`, `time_end`, `day`, `position_id`, `username`)
                            VALUES ($time_start, $time_end, '$day', $position_id, '$username'); ";
  	$create_assig_result = mysqli_query($con,$create_assig_query);
  	if(!$create_assig_result){
  		//If the query was not executed, give an error alert with the mysql error as the message
  		echo '<script> parent.parent.errorAlert("'. mysqli_error($con) .'", "http://140.209.47.120/calendar/CalendarIndex.php");</script>';
  	}else{
  		//If the position is created, give a success alert.
  		echo '<script> parent.parent.successAlert("Assignment successfully created!", "http://140.209.47.120/calendar/CalendarIndex.php");</script>';
  	}
  }

  function updateAssignment($assignment_id, $time_start, $time_end, $day, $position_id, $username) {
    require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
    $query = "UPDATE `calendar_assignments`
              SET `time_start`=$time_start, `time_end`=$time_end, `day`='$day', `position_id`=$position_id, `username`='$username'
              WHERE `assignment_id`=$assignment_id;";
    $result = mysqli_query($con,$query);
    if(!$result){
      //If the query was not executed, give an error alert with the mysql error as the message
      echo '<script> parent.parent.errorAlert("'. mysqli_error($con) .'", "http://140.209.47.120/calendar/CalendarIndex.php");</script>';
    }else{
      //If the position is created, give a success alert.
      echo '<script> parent.parent.successAlert("Assignment successfully updated!", "http://140.209.47.120/calendar/CalendarIndex.php");</script>';
    }
  }

  function deleteAssignment($assignment_id) {
  	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
  	//This query selects all positions that do not have users assigned to them.
  	$remove_assign_query = "
  		DELETE FROM `calendar_assignments`
  		WHERE `calendar_assignments`.`assignment_id` = $assignment_id;
  		";
  	$remove_assign_result = mysqli_query($con,$remove_assign_query);
  	if(!$remove_assign_result){
  		//If the query was not executed, give an error alert with the mysql error as the message
  		echo '<script> parent.parent.errorAlert("'. mysqli_error($con) .'", "http://140.209.47.120/calendar/CalendarIndex.php");</script>';
  	}else{
  		//If the position is created, give a success alert.
  		echo '<script> parent.parent.successAlert("Assignment successfully deleted!", "http://140.209.47.120/calendar/CalendarIndex.php");</script>';
  	}
  }

  function allStudents(){
  	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
  	$all_stu_query = "
  		SELECT username, fname, lname, role
  		FROM users INNER JOIN login USING(username)
  		WHERE role = 1
  		ORDER BY lname ASC;";
  	$all_stu_result = mysqli_query($con,$all_stu_query);
  	if(mysqli_num_rows($all_stu_result) > 0){
  		$toEcho = '';
  		while($row = mysqli_fetch_assoc($all_stu_result)){
  			if(strcmp($row['lname'], '') == 0 || strcmp($row['fname'], '') == 0){
  				$firstAndLast = $row['username'];
  			}else{
  				$firstAndLast = $row['lname'] .', '. $row['fname'];
  			}
  			$toEcho .= '<option value="' . $row['username'] . '">' . $firstAndLast . '</option>
  			';
  		}
      $toEcho .= '<option value="CLOSED">CLOSED</option>';
  		echo $toEcho;
  	}
  }

  function allPositions(){
  	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
  	$all_stu_query = "
  		SELECT *
  		FROM calendar_positions
  		";
  	$all_stu_result = mysqli_query($con,$all_stu_query);
  	if(mysqli_num_rows($all_stu_result) > 0){
  		$toEcho = '';
  		while($row = mysqli_fetch_assoc($all_stu_result)){
  			$toEcho .= '<option value="'.$row['position_id'].'">'.$row['position_name'].'</option>
  			';
  		}
  		echo $toEcho;
  	}
  }

  function allAssignments() {
    require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
    $query = "
      SELECT *
      FROM  `calendar_positions` cp JOIN `calendar_assignments` ca ON cp.position_id = ca.position_id
        JOIN `users` u ON ca.username = u.username;
      ";
    $result = mysqli_query($con,$query);
    if(mysqli_num_rows($result) > 0){
      $toEcho = '';
      while($row = mysqli_fetch_assoc($result)){
        $day = "";
        if ($row['day'] == 0) {$day = "Sunday";}
        else if ($row['day'] == 1) {$day = "Monday";}
        else if ($row['day'] == 2) {$day = "Tuesday";}
        else if ($row['day'] == 3) {$day = "Wednesday";}
        else if ($row['day'] == 4) {$day = "Thursday";}
        else if ($row['day'] == 5) {$day = "Friday";}
        else if ($row['day'] == 6) {$day = "Saturday";}

        if ($row['fname'] == "" || $row['lname'] == "") {
          $toEcho .= '<option value="'.$row['assignment_id'].'">'.$row['username'].': '.$day.' ('.printDuration($row['time_start'], $row['time_end']).') - '.$row['position_name'].'</option>
          ';
        } else {
          $toEcho .= '<option value="'.$row['assignment_id'].'">'.$row['lname'].', '.$row['fname'].': '.$day.' ('.printDuration($row['time_start'], $row['time_end']).') - '.$row['position_name'].'</option>
          ';
        }
      }
      echo $toEcho;
    }
  }

  function printTime($time) {
    $ret = "";
    if ($time >= 12) {
      if ($time > 12) {
        $ret .= $time-12;
      } else {
        $ret .= $time;
      }
      $ret .= ':00 pm';
    } else {
      $ret .= $time.':00 am';
    }

    return $ret;
  }

  function printDuration($startTime, $endTime) {
    $ret = "";
    if ($startTime >= 12) {
      if ($startTime > 12) {
        $ret .= $startTime-12;
      } else {
        $ret .= $startTime;
      }
      $ret .= 'p';
    } else {
      $ret .= $startTime.'a';
    }
    $ret .= '-';
    if ($endTime >= 12) {
      if ($endTime > 12) {
        $ret .= $endTime-12;
      } else {
        $ret .= $endTime;
      }
      $ret .= 'p';
    } else {
      $ret .= $endTime.'a';
    }

    return $ret;
  }

  function checkForTimeOverlap($assignment_id, $time_start, $time_end, $position_id, $day) {
    require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
    if ($assignment_id == "") {
      $query = "SELECT *
                FROM `calendar_assignments`
                WHERE `position_id`=$position_id;";
    } else {
      $query = "SELECT *
                FROM `calendar_assignments`
                WHERE `position_id`=$position_id AND `assignment_id` <> $assignment_id;";
    }

    $result = mysqli_query($con,$query);
    if(!$result){
      return true;
    } else {
      $assignments_array = array();
      while ($assignments_row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $assignments_array[] = $assignments_row;
      }

      foreach($assignments_array as $assignments_row) {
        if ((strpos($assignments_row['day'], "U") !== false) && (strpos($day, "U") !== false)
          || (strpos($assignments_row['day'], "M") !== false) && (strpos($day, "M") !== false)
          || (strpos($assignments_row['day'], "T") !== false) && (strpos($day, "T") !== false)
          || (strpos($assignments_row['day'], "W") !== false) && (strpos($day, "W") !== false)
          || (strpos($assignments_row['day'], "R") !== false) && (strpos($day, "R") !== false)
          || (strpos($assignments_row['day'], "F") !== false) && (strpos($day, "F") !== false)
          || (strpos($assignments_row['day'], "S") !== false) && (strpos($day, "S") !== false)) {

          if (($time_start < $assignments_row['time_end']) && ($time_end > $assignments_row['time_start'])) {
            return true;
          } else {
            return false;
          }
        }
      }
    }
  }
?>
