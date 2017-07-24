<?php

// Populate table rows with user imformation
function populateTableRows(){
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$buildUserRowsSQL = "
		SELECT username, fname, lname, phone_number
		FROM users JOIN login USING(username)
		WHERE role = 1
	";
	$buildUserRowsResult = mysqli_query($con, $buildUserRowsSQL);
	if ($buildUserRowsResult) {
		while ($row = mysqli_fetch_assoc($buildUserRowsResult)) {
			$cur_user = $row['username'];
			$fname = $row['fname'];
			$lname = $row['lname'];
			$pnum = $row['phone_number'];
			populateTableRowsHelper($cur_user, $fname, $lname, $pnum);
		}
	}
}
function populateTableRowsHelper($user, $fname, $lname, $pnum){
	$user_temp = $user;
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$buildPermRowsSQL = "
		SELECT *
		FROM td_perm_names LEFT JOIN (
									  SELECT *
									  FROM td_perm_users
									  WHERE username LIKE '$user') AS T USING(perm_id)
		ORDER BY perm_name;
	";
	$buildPermsResult = mysqli_query($con, $buildPermRowsSQL);
	if($buildPermsResult){
		if(mysqli_num_rows($buildPermsResult) > 0){
			echo "
				<tr>
					<th>{$user_temp}</th>
					<th>{$lname}, {$fname}</th>
					<th><a href='TDAccountAccess.php?user={$user_temp}'>Edit</a></th>
					";
			//Loops through all perm_names
			while($row = mysqli_fetch_assoc($buildPermsResult)){
				if(isset($row['username'])){ //If the username field is set, then the user has that permission
					echo "
						<th style='text-align: center;'><span style=\"color: green;\" class='glyphicon glyphicon-ok'></span></th>";
				}else{ //If the username field is NULL, then the user does not have that permission
					echo "
						<th></th>";
				}
			}
		}
	}
}

//Populate table head
function populateTableColumns() {
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$TColSQL = "
		SELECT *
		FROM td_perm_names
		ORDER BY perm_name;
	";
	$TColResult = mysqli_query($con, $TColSQL);
	if($TColResult){
		if(mysqli_num_rows($TColResult) > 0) {
			while($row = mysqli_fetch_assoc($TColResult)) {
				$perm_name = html_entity_decode($row['perm_name']);
				echo "<th>{$perm_name}</th>";
			}
		}else{
			// If no rows returned:
			echo "<p><b>Error: No Permission Fields Found</b></p>";
		}
	}else{
		// If DB returns error:
		echo "<p><b>Error: " . mysqli_error($con) . "</b></p>";
	}
}

// Populate form inputs
function getUserInfo($user){
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$getInfoSQL = "
		SELECT fname, lname, phone_number, ust_id
		FROM users 
		WHERE username LIKE '$user'
		";
	$getInfoResult = mysqli_query($con, $getInfoSQL);
	if($getInfoResult){
		if(mysqli_num_rows($getInfoResult) > 0){
			//If the user is found, set their info to variables and strip spaces
			$userInfo = mysqli_fetch_assoc($getInfoResult);
			$fname = str_replace(' ', '', $userInfo['fname']);
			$lname = str_replace(' ', '',$userInfo['lname']);
			$pnum = $userInfo['phone_number'];
			$ust_id = $userInfo['ust_id'];
		}else{
			//If the user is not found, or $user is empty, set the following variables to empty strings
			$fname = '';
			$lname = '';
			$pnum = '';
		}
		echo "
						<div class=\"form-group\">
							<label for=\"fullname\">Full Name:</label>
							<input type=\"text\" class=\"form-control\" id=\"fullname\" name=\"fullname\" value=\"{$fname} {$lname}\" required>
						</div>
						<div class=\"form-group\">
							<label for=\"username\">Username:</label>
							<input type=\"text\" class=\"form-control\" id=\"username\" name=\"username\" value=\"{$user}\" required>
						</div>
						<div class=\"form-group\">
							<label for=\"user_id\">St. Thomas ID Number:</label>
							<input type=\"text\" class=\"form-control\" id=\"user_id\" name=\"user_id\" value=\"{$ust_id}\">
						</div>
						<div class=\"form-group\">
							<label for=\"phonenum\">Phone Number:</label>
							<input class=\"form-control\" id=\"phone\" name=\"phonenum\" value=\"{$pnum}\">
						</div>
		";
	}
}

// This function builds the "Permissions" section by producing checkboxes
function buildPerms($user) {
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$buildPermsSQL = "
		SELECT *
		FROM td_perm_names 
			LEFT JOIN (SELECT * 
				  FROM td_perm_users 
				  WHERE username LIKE '$user') AS T USING(perm_id) 
		ORDER BY perm_name;
	";
	$buildPermsResult = mysqli_query($con, $buildPermsSQL);
	if($buildPermsResult){
		if(mysqli_num_rows($buildPermsResult) > 0){
			//If the $user variable is not empty, pring the following message.
			if(strcmp($user, '') != 0){
				echo "<p><i>Fields that are <b>bold</b> are permissions that the current user already has.</i></p>";
			}
			//Loops through all perm_names
			while($row = mysqli_fetch_assoc($buildPermsResult)){
				$perm_name = html_entity_decode($row['perm_name']);
				$perm_id = $row['perm_id'];
				if(isset($row['username'])){ //If the username field is set, then the user has that permission
					echo "
						<div class=\"checkbox\">
							<label><input type=\"checkbox\" name=\"{$perm_id}_cb\" value=\"{$perm_name}\" checked><b>{$perm_name}</b></label>
						</div>";
				}else{ //If the username field is NULL, then the user does not have that permission
					echo "
						<div class=\"checkbox\">
							<label><input type=\"checkbox\" name=\"{$perm_id}_cb\" value=\"{$perm_name}\">{$perm_name}</label>
						</div>";
				}
			}
		}else{
			// If no rows returned:
			echo "<p><b>Error: No Permission Fields Found</b></p>";
		}
	}else{
		// If DB returns error:
		echo "<p><b>Error: " . mysqli_error($con) . "</b></p>";
	}
}