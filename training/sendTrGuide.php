<?php
/*
 * sendGuide.php
 * --------------------
 * Author: Nick Scheel
 * Purpose: receives AJAX POST requests from NewGuide.php and EditGuide.php
 * NewGuide Input:
 * 		title, topic, id (set to -1)
 * EditGuide Input:
 * 		title, topic, id, body, overview
 *
 * 1. Receive data and set variables
 * 2. Check id.
 * 		2a. If -1, guide is new and query must be INSERT INTO
 * 		2b. If greater than 0, guide is already created and query must be UPDATE
 * 3. Run queries
 * 4. If successful
 * 		4a. For NewGuide, return redirect to editor
 * 		4b. For EditGuide, return redirect to Guide to view it
 *
 */

//Do not continue if guide_id is not set
if(isset($_REQUEST['guide_id'])){
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
// For both cases, guide name and topic will be needed
	$title = htmlentities($_REQUEST['title'], ENT_QUOTES, 'UTF-8');
	$path = preg_replace("/[^A-Za-z0-9]/", "", $title);
	$id = $_REQUEST['guide_id'];
// Guide is new, and needs to be inserted into the DB
	if ( $id == -1 ) {
		// Create insert query
		$query = "INSERT INTO `training_pages` (`id`, `title`, `path`, `body`) VALUES (NULL, '$title', '$path', '');";
		$return = "EditTrainingGuide.php?toEdit=" . $path;
	}
// Guide already exists, and needs to be updated
	else {
		$body_orig = htmlentities($_REQUEST['body_helper'], ENT_QUOTES, 'UTF-8');
		$body_fixed = str_replace("panel-collapse collapse in", "panel-collapse collapse", $body_orig);
		// Create update query
		$query = "UPDATE `training_pages` SET `title` = '$title', `path` = '$path', `body` = '$body_fixed' WHERE `training_pages`.`id` = $id;";
		$return = "Page.php?id=" . $id;
	}
	$result = mysqli_query($con, $query);
	if ($result) {
		echo $return;
	} else {
		echo "error";
	}
}