<?php 
include($_SERVER['DOCUMENT_ROOT'] . '/loginutils/auth.php');
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php");
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

$id = $_POST['id'];

//Obtain all badges with that id that exist in the table
$query = "SELECT id FROM `badges_held` WHERE id=$id;";
$result = mysqli_query($con,$query);

if (!$result) {
	echo '<div class="alert alert-danger" role="alert"><strong>Query 1: Error. </strong>';
	echo mysqli_error($con);
	echo '</div>';
} else {	
	echo '<div class="alert alert-danger" role="alert"><strong>Query 1: Success! </strong> Badges database pulled';
		
	$held_array = mysqli_fetch_array($result, MYSQLI_NUM);
	echo '<div class="alert alert-danger" role="alert"><strong>Query 1: </strong> Badges stored in array';
		
	//Begin remove query loop
	foreach($held_array as $held_items) {
		$delete_held_query = 	"DELETE FROM `badges_held`
								WHERE id='$id';";

		$delete_held_result = mysqli_query($con, $delete_held_query);
		if(!$delete_held_result) {
			echo '<div class="alert alert-danger" role="alert"><strong>Query 2: Error. </strong>';
			echo mysqli_error($con);
			echo '</div>';
		} else {
			echo '<div class="alert alert-success" role="alert"><strong>Query 2: Success!</strong> Badge removed from users successfully</div>';
		}
	}
}

$delete_badge_query = "DELETE FROM `badges`
						WHERE id='$id';";

$delete_badge_result = mysqli_query($con, $delete_badge_query);

if(!$delete_badge_result) {
	echo '<div class="alert alert-danger" role="alert"><strong>Query 2: Error. </strong>';
	echo mysqli_error($con);
	echo '</div>';
} else {
	echo '<div class="alert alert-success" role="alert"><strong>Query 2: Success!</strong> Badge deleted successfully</div>';
}

?>