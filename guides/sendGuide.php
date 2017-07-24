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
function alertSuperusersAndAdmins($req_title, $filepath){
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	//Set title and message
	$title_fixed = str_replace("REQUESTED: ","",$req_title);
	$title = "Guide Requested: {$title_fixed}";
	$message = "A user has requested that a guide be created with the topic: <b>{$title_fixed}</b>.<br><br>";
	$message .= "The Guide Editor page for this guide can be found <a href=\"https://tdta.stthomas.edu/guides/Guide.php?guide={$filepath}\">here</a>.";
	//Query selects all users who are Superuser and above
	$sql = "SELECT username FROM login WHERE admin_status > 1;";
	$result = mysqli_query($con, $sql);
	$multiquery = "";
	if($result){
		while($row = mysqli_fetch_assoc($result)){
			$cur_user = $row['username'];
			$multiquery .= "INSERT INTO `notifications` (id, date_created, viewed, dismissed, username, title, message, all_admin) 
							  VALUES(NULL, NULL, 1, 1, '$cur_user', '$title', '$message', 0); ";
		}
		mysqli_multi_query($con, $multiquery);
	}
}
//Do not continue if guide_id is not set
if(isset($_REQUEST['guide_id'])){
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
// For both cases, guide name and topic will be needed
	$guide_name = htmlentities($_REQUEST['title'], ENT_QUOTES, 'UTF-8');
	$topic = htmlentities($_REQUEST['topicselect'], ENT_QUOTES, 'UTF-8');
	$filepath = preg_replace("/[^A-Za-z0-9]/", "", $guide_name);
	$id = $_REQUEST['guide_id'];
// Guide is new, and needs to be inserted into the DB
	if ( $id == -1 ) {
		// Create insert query
		$query = "INSERT INTO `guides` (`id`, `topic`, `guide_name`, `filename`, `overview`, `body`) VALUES (NULL, '$topic', '$guide_name', '$filepath', '$overview', '');";
		$return = "EditGuide.php?toEdit=" . $filepath;
	}
// Guide is being requested, and needs to be inserted into the DB with a modified name
	if ( $id == -2 ) {
		// Add "REQESTED" to guide name
		$guide_name = "REQUESTED: " . $guide_name;
		// Create insert query
		$query = "INSERT INTO `guides` (`id`, `topic`, `guide_name`, `filename`, `overview`, `body`) VALUES (NULL, '$topic', '$guide_name', '$filepath', '$overview', '');";
		$return = "GuideIndex.php";
		alertSuperusersAndAdmins($guide_name, $filepath);
	}	
// Guide already exists, and needs to be updated
	else {
		$overview = htmlentities($_REQUEST['overview'], ENT_QUOTES, 'UTF-8');
		$body_orig = htmlentities($_REQUEST['body_helper'], ENT_QUOTES, 'UTF-8');
		$body_fixed = str_replace("panel-collapse collapse in", "panel-collapse collapse", $body_orig);
		// Create update query
		$query = "UPDATE `guides` SET `topic` = '$topic', `guide_name` = '$guide_name', `filename` = '$filepath', `overview` = '$overview',  `body` = '$body_fixed' WHERE `guides`.`id` = $id;";
		$return = "Guide.php?guide=" . $filepath;
	}
	$result = mysqli_query($con, $query);
	if ($result) {
		echo $return;
	} else {
		echo "error";
	}
}
