<?php
//include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/AdminAuth.php");

    //  GRAB POST VARIABLES
    $status             = $_POST['status'];
    $full_name          = $_POST['fullname'];
    $ust_id             = $_POST['user_id'];
    $username           = $_POST['username'];
    $phone              = $_POST['phonenum'];
	$permissions_add	= [];
	$permissions_remove	= [];
	$permissions_keep	= [];
	$update_query		= "";
    $extra_permissions  = $_POST['input[]'];

	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

	$buildPermsSQL = "
			SELECT *
			FROM td_perm_names LEFT JOIN (
										  SELECT * 
										  FROM td_perm_users 
										  WHERE username LIKE '$username') AS T USING(perm_id)
			ORDER BY perm_name;
		";
	$buildPermsResult = mysqli_query($con, $buildPermsSQL);
	if($buildPermsResult) {
		//If successful db query, do:
		while ($row = mysqli_fetch_assoc($buildPermsResult)) {
			// Loops through all permissions in db
			$perm_id = $row['perm_id'];
			$perm_name = $row['perm_name'];
			//Sets var to look in $_POST for the checkbox
			$formfield_name = $perm_id . "_cb";
			if (isset($_POST[$formfield_name]) && isset($row['username'])) {
				// They already had that permission, no change
				array_push($permissions_keep, "<b>KEEP:</b> {$perm_name}");
			}
			if (isset($_POST[$formfield_name]) && !isset($row['username'])) {
				// They are granted this permission, did not have it previously
				array_push($permissions_add, "<b>ADD:</b> {$perm_name}");
				$update_query .= "INSERT INTO `td_perm_users` (`perm_id`, `username`) VALUES ($perm_id, '$username'); ";
			}
			if (!isset($_POST[$formfield_name]) && isset($row['username'])) {
				// This permission is being removed
				array_push($permissions_remove, "<b>REMOVE:</b> {$perm_name}");
				$update_query .= "DELETE FROM `td_perm_users` WHERE `td_perm_users`.`perm_id` = $perm_id AND `td_perm_users`.`username` LIKE '$username'; ";
			} else {
				// They dont have it and are not getting it
			}
		}
		$update_result = mysqli_multi_query($con, $update_query);
		if(!$update_query && strcmp("Query was empty", mysqli_error($con)) != 0){
			echo mysqli_error($con);
		}
	}else {
		echo mysqli_error($con);
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title> Title </title>
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
    <style>
        #content {
            margin-top: 50px;
        }
    </style>
</head>
<body>

<div class="container-fluid text-center">

	<div class="row content">
		<div class="col-md-1 text-left">
			<!-- White space on left 1/12th of the page -->
		</div>

		<div class="col-md-10 text-left" id="content">
				<h1>Output:</h1>
				<p><a href="ViewPermissions.php">Return to User Table</a></p>
				<h2>User Info</h2>
                <p>
					<b>Full Name:</b> <?php echo $full_name; ?><br>
					<b>Username:</b> <?php echo $username; ?><br>
					<b>St. Thomas ID:</b> <?php echo $ust_id; ?><br>
					<b>Phone Number:</b> <?php echo $phone; ?><br>
				</p>
				<h2>Permissions: Add</h2>
                <p>
                    <?php
						if(sizeof($permissions_add) > 0){
							foreach($permissions_add as $permissions_add) {
								echo $permissions_add . "<br>";
							}
						}else{
							echo "<i>No Changes Found</i>";
						}
					?>
				</p>
				<?php
					// If any values are entered, print them. The form will submit an empty value no matter what,
					// so the first if() accounts for this
					if(sizeof($_POST['input']) != 1 && strcmp($_POST['input'][0], '') != 0){
						echo "<h4>Other</h4><p>";
						require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
						$multiquery = "";
						foreach($_POST['input'] as $index => $value) {
							if(strcmp($value, '') != 0){
								$multiquery .= "INSERT INTO `td_perm_names` (`perm_id`, `perm_name`) VALUES (NULL, '$value'); ";
								echo "<b>ADD:</b> {$value} <br>";
							}
						}
						$mq_result = mysqli_multi_query($con, $multiquery);
						if($mq_result){
							echo "<br>All above permissions have been added to the Permission List.";
						}else{
							echo mysqli_error($con);
						}
						require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
						foreach($_POST['input'] as $index => $value) {
							if(strcmp($value, '') != 0){
								$insert_multiquery .= "INSERT INTO `td_perm_users` (`perm_id`, `username`) 
																SELECT `td_perm_names`.`perm_id`, '$username' 
																FROM `td_perm_names` 
																WHERE `td_perm_names`.`perm_name` LIKE '$value'; ";
							}
						}
						$mq_result2 = mysqli_multi_query($con, $insert_multiquery);
						if(!$mq_result2){
							echo mysqli_error($con);
						}
						echo "</p>";
					}
				?>
				<h2>Permissions: Remove</h2>
				<p>
					<?php
					foreach($permissions_remove as $permissions_remove) {
						echo $permissions_remove . "<br>";
					}
					?>
				</p>
				<h2>Permissions: Unchanged</h2>
				<p>
					<?php
					foreach($permissions_keep as $permissions_keep) {
						echo $permissions_keep . "<br>";
					}
					?>
				</p>

		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
		<br><br><br><br><br>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->


</body>
</html>
