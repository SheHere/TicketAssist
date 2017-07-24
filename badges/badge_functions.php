<?php
function populateBadges()
{
    require('../loginutils/connectdb.php');

    $usrstatus = $_SESSION['admin_status'];
    $output = "";

    $sql = "SELECT id, name, prerequisites, icon FROM badges";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        //Insert something that would happen if the information was not placed in
        //the database correctly.
        echo 'ERROR';
        echo mysqli_error($con);
    }

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $output .=
                '<tr>'
                . '<td width="10px"><i class="' . $row["icon"] . '" aria-hidden="true"></i></td>'
                . '<td width="200px"><strong>' . html_entity_decode($row["name"]) . '</strong></td>'
                . '<td>' . html_entity_decode($row["prerequisites"]) . '</td>'
                . '<td>' . calcPercentOfTotal($row["id"]) . '</td>';

            if ($usrstatus == 3) {
                $output .= '<td><a href="badge_manager.php?badge=' . $row["id"] . '" class="btn btn-default pull-right" role="button">Edit this badge</a></td>';
                $output .= '<td><button onclick="deletePrompt(' . $row["id"] . ')" type="button" class="btn btn-danger pull-right">Delete this badge</button></td>';
                $output .= '<form id="form' . $row["id"] . '" name="form' . $row["id"] . '" action="badge_deleter.php" target="form_target" method="post"><input type="hidden" name="id" value="' . $row['id'] . '"></form>';
            }

            $output .= '</tr>';
        }
    }

    /*
    Example Row
     <tr>
        <td width="10px"><i class="fa fa-info-circle fa-5x" aria-hidden="true"></i></td>
        <td width="200px"><strong>Test badge</strong></td>
        <td>Test prerequisite</td>
        <td><a href="badge_editor.php?badge="1">Edit this badge</a></td>
        <td><button onclick="deletePrompt(' . $row["id"] . ')" type="button" class="btn btn-danger pull-right">Delete this badge</button></td>';
        <form id="form1" name="form1" action="badge_deleter.php" method="post"><input type="hidden" name="id" value="1"></form>';
    </tr>
     */

    echo $output;
}

function populateIconTableCreator()
{
    require('../loginutils/connectdb.php');
    include('icon_array.php');

    foreach ($icons as $item) {
        echo
            '<tr>
				<th class="dt-center">
					<div class="radio">
						<label class="radio-inline">
							<input type="radio" name="selectedIcon" value="' . $item . '">
						</label>
					</div>
				</th>
				<th>
					<i class="' . $item . '" aria-hidden="true"></i> ' . substr($item, 6) . '
				</th>
			</tr>';
    }
}

function populateIconTableEditor($id)
{
    require('../loginutils/connectdb.php');
    include('icon_array.php');

    $sql = "SELECT icon FROM badges WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        //Insert something that would happen if the information was not placed in
        //the database correctly.
        echo 'ERROR';
        echo mysqli_error($con);
    }

    $row = mysqli_fetch_assoc($result);
    foreach ($icons as $item) {

        echo
        '<tr>
				<th class="dt-center">
					<div class="radio">
						<label class="radio-inline">';

        if (strcmp($row["icon"], ($item . ' fa-5x')) == 0) {
            echo '<input type="radio" name="selectedIcon" value="' . $item . '" checked="checked">';
        } else {
            echo '<input type="radio" name="selectedIcon" value="' . $item . '">';
        }

        echo
            '</label>
					</div>
				</th>
				<th>
					<i class="' . $item . '" aria-hidden="true"></i> ' . substr($item, 6) . '
				</th>
			</tr>';
    }
}

function populateUserTableCreator()
{
    require('../loginutils/connectdb.php');

    $output = "";

    $sql = "SELECT username, fname, lname FROM users";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        //Insert something that would happen if the information was not placed in
        //the database correctly.
        echo 'ERROR';
        echo mysqli_error($con);
    }

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $output .=
                '<tr>
					<th class="dt-center">
						<div class="checkbox">
							<label class="checkbox-inline">
								<input type="checkbox" name="selectedUser[]" value="' . $row["username"] . '">
							</label>
						</div>
					</th>
					<th>
						' . $row["username"] . ': ' . $row["fname"] . ' ' . $row["lname"] . '
					</th>
				</tr>';
        }
    }

    echo $output;
}

function populateUserTableEditor($id)
{
    require('../loginutils/connectdb.php');

    $output = "";

    $sql = "SELECT users.username, users.fname, users.lname, badges_held.id
			FROM users LEFT JOIN badges_held
			ON (users.username=badges_held.username);";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        //Insert something that would happen if the information was not placed in
        //the database correctly.
        echo 'ERROR';
        echo mysqli_error($con);
    }

    if (mysqli_num_rows($result) > 0) {
        $checked_users = array();

        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["id"] == $id) {
                array_push($checked_users, $row["username"]);
                $output .=
                    '<tr>
						<th class="dt-center">
							<div class="checkbox">
								<label class="checkbox-inline">
									<input type="checkbox" name="selectedUser[]" value="' . $row["username"] . '" checked="checked">
								</label>
							</div>
						</th>
						<th>
							' . $row["username"] . ': ' . $row["fname"] . ' ' . $row["lname"] . '
						</th>
					</tr>';
            }
        }

        mysqli_data_seek($result, 0);
        while ($row = mysqli_fetch_assoc($result)) {
            if (!in_array($row["username"], $checked_users)) {
                array_push($checked_users, $row["username"]);
                $output .=
                    '<tr>
						<th class="dt-center">
							<div class="checkbox">
								<label class="checkbox-inline">
									<input type="checkbox" name="selectedUser[]" value="' . $row["username"] . '">
								</label>
							</div>
						</th>
						<th>
							' . $row["username"] . ': ' . $row["fname"] . ' ' . $row["lname"] . '
						</th>
					</tr>';
            }
        }
    }

    echo $output;
}

function getName($id)
{
    $name = "";

    require('../loginutils/connectdb.php');

    $sql = "SELECT name FROM badges WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        //Insert something that would happen if the information was not placed in
        //the database correctly.
        echo 'ERROR';
        echo mysqli_error($con);
    }

    $row = mysqli_fetch_assoc($result);
    $name = $row["name"];

    return $name;
}

function getPrerequisites($id)
{
    $prerequisites = "";

    require('../loginutils/connectdb.php');

    $sql = "SELECT prerequisites FROM badges WHERE id = $id";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        //Insert something that would happen if the information was not placed in
        //the database correctly.
        echo 'ERROR';
        echo mysqli_error($con);
    }

    $row = mysqli_fetch_assoc($result);
    $prerequisites = $row["prerequisites"];

    return $prerequisites;
}

function calcPercentOfTotal($id)
{
    require('../loginutils/connectdb.php');

    $output = 0;

    $query = "SELECT * FROM users";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo '<div class="alert alert-danger" role="alert"><strong>Query 1: Error. </strong>';
        echo mysqli_error($con);
        echo '</div>';
    } else {
        $numUsersTotal = mysqli_num_rows($result);
    }

    $query2 = "SELECT * FROM badges_held WHERE id=$id";
    $result2 = mysqli_query($con, $query2);

    if (!$result2) {
        echo '<div class="alert alert-danger" role="alert"><strong>Query 2: Error. </strong>';
        echo mysqli_error($con);
        echo '</div>';
    } else {
        $numUsersWithBadge = mysqli_num_rows($result2);
    }

    $output = $numUsersWithBadge / $numUsersTotal;
    return $numUsersWithBadge . " (" . sprintf("%.2f%%", $output * 100) . ")";
}

function provideBadge($id, $username)
{
    require('../loginutils/connectdb.php');

    $query = "SELECT * FROM badges_held WHERE username=$username AND id=$id";
    $result = mysqli_query($con, $query);

    if (!$result) {
        echo '<div class="alert alert-danger" role="alert"><strong>Query 1: Error. </strong>';
        echo mysqli_error($con);
        echo '</div>';

        return false;
    } else {
        if(mysqli_num_rows($result) == 0) {
            $query = "INSERT INTO badges_held (username, id)
                       VALUES ($username, $id)";
            $result = mysqli_query($con, $query);
            if (!$result) {
                echo '<div class="alert alert-danger" role="alert"><strong>Query 2: Error. </strong>';
                echo mysqli_error($con);
                echo '</div>';

                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }
}
?>
