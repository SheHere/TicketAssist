<?php
include($_SERVER['DOCUMENT_ROOT'] . '/loginutils/auth.php');
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php");
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

$badge_icon = $_POST['selectedIcon'];
$badge_name = htmlentities($_POST['nameInput'], ENT_QUOTES, 'UTF-8');
$badge_prerequisites = htmlentities($_POST['prerequisiteInput'], ENT_QUOTES, 'UTF-8');
$selected_users = $_POST['selectedUser'];

if (isset($_GET['badge'])) {
	$id = $_GET['badge'];
}

//Add the badge to the index
if (isset($_GET['badge'])) {
	$query = "UPDATE `badges`
			SET name='$badge_name', prerequisites='$badge_prerequisites', icon='$badge_icon fa-5x'
			WHERE id='$id';";
} else {
	$query = "INSERT INTO `badges` (name, prerequisites, icon)
			VALUES ('$badge_name', '$badge_prerequisites', '$badge_icon fa-5x');";
}

$result = mysqli_query($con,$query);

if(!$result) {
	//Insert something that would happen if the information was not placed in
	//the database correctly.
	echo '<div class="alert alert-danger" role="alert"><strong>Query 1: Error. </strong>';
	echo mysqli_error($con);
	echo '</div>';
} else {
	echo '<div class="alert alert-success" role="alert"><strong>Query 1: Success!</strong> Badge has been updated.</div>';

	if (isset($_GET['badge'])) {
		//Obtain all badges with that id that exist in the table
		$query2 = "SELECT id FROM `badges_held` WHERE id=$id;";
		$result2 = mysqli_query($con,$query2);

		if (!$result2) {
			echo '<div class="alert alert-danger" role="alert"><strong>Query 2: Error. </strong>';
			echo mysqli_error($con);
			echo '</div>';
		} else {

			echo '<div class="alert alert-danger" role="alert"><strong>Query 2: Success! </strong> Badges database pulled';

			$held_array = mysqli_fetch_array($result2, MYSQLI_NUM);
			echo '<div class="alert alert-danger" role="alert"><strong>Query 2: </strong> Badges stored in array';

			//Begin remove query loop
			foreach($held_array as $held_items) {
				$query3 = 	"DELETE FROM `badges_held`
							WHERE id='$id';";

				$result3 = mysqli_query($con,$query3);
				if(!$result3) {
					echo '<div class="alert alert-danger" role="alert"><strong>Query 3: Error. </strong>';
					echo mysqli_error($con);
					echo '</div>';
				} else {
					echo '<div class="alert alert-success" role="alert"><strong>Query 3: Success!</strong> Badge removed from users successfully</div>';
				}
			}
		}
	}

	//Add the badge to the designated users
	foreach($selected_users as $user) {
		//Begin readdition query
		if (isset($_GET['badge'])) {
			$add_query = "INSERT INTO `badges_held` (username, id)
							VALUES ('$user', '$id');";
		} else {
			$add_query = "INSERT INTO `badges_held` (username, id)
							VALUES ('$user', (SELECT MAX(id) FROM badges));";
		}

		$add_result = mysqli_query($con,$add_query);
		if(!$add_result) {
			echo '<div class="alert alert-danger" role="alert"><strong>Query 4: Error. </strong>';
			echo mysqli_error($con);
			echo '</div>';
		} else {
			echo '<div class="alert alert-success" role="alert"><strong>Query 4: Success!</strong> Badge added to user ' . $user. ' successfully</div>';
		}
	}
}
?>
