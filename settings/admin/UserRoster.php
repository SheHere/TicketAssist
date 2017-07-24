<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>User Roster</title>
	<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	datatablesHeader();
	?>
  <style>

    .footer{
    	padding-top: 30px;
	}
  </style>

	<!-- Configures the datatable so that it targets the table, order by descending, sets it to a frame so that we can see the buttons at the bottom without scrolling to them. -->
	<script>
		$(document).ready(function() {
			var userTable = $('#userTable').DataTable({
				scrollY: '55vh',
				scrollCollapge: true,
				columnDefs: [{width: '5%', targets: 0}],
				bPaginate: false
			});
			$('[data-toggle="tooltip"]').tooltip();

			$("#userForm").submit(function(e) {
				e.preventDefault();
				userTable
					.search('')
					.columns().search('')
					.draw();
				document.getElementById("userForm").submit();
			});
		});
	</script>
  <script>

	</script>

</head>
<body>

<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
?>

<div class="container-fluid text-center">
  <div class="row content">
     <div class="col-md-1 text-left">
		<!-- White space on left 1/12th -->
	 </div>
	<!--
	---- Begin main section, which will call the HTML from the input file
	--->
    <div class="col-md-10 text-left">

		<h1>User Roster</h1>
		<?php
		if($_GET['show'] == "inactive"){
			echo '<p><a href="https://tdta.stthomas.edu/settings/admin/UserRoster.php">Hide Inactive Users</a></p>';
		}else{
			echo '<p><a href="https://tdta.stthomas.edu/settings/admin/UserRoster.php?show=inactive">Show Inactive Users</a></p>';
		}
		?>
		<!--
		---- The classe "sortable" calls .js file that allows the table to be sorted, the class "table" is a Bootstrap
		---- class that formats it nicely, and "table-striped" is a Bootstrap class that makes every-other entry
		---- a gray color so each entry stands out better.
		-->
		<form id="userForm" action="updateUserStatus.php" method="post" target="iFrame" onsubmit="return clearTableSearch();">
			<table id="userTable" class="display table table-striped">
				<thead>
					<tr>
						<th>Username</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>Phone Number</th>
						<th>Role <a id="infobutton" class=" btn-link" type="button" style="margin-bottom: -5px;" onclick="infoAlert('Please see <a href=\'https://tdta.stthomas.edu/documentation/Documentation.php?page=Accounts\'>Account Documentation</a> for more information.');"><i style="color:black;" class="fa fa-question-circle fa-1x" aria-hidden="true"></i></a>
                        </th>
						<th>Admin Status <a id="infobutton" class=" btn-link" type="button" style="margin-bottom: -5px;" onclick="infoAlert('Please see <a href=\'https://tdta.stthomas.edu/documentation/Documentation.php?page=Accounts\'>Account Documentation</a> for more information.');"><i style="color:black;" class="fa fa-question-circle fa-1x" aria-hidden="true"></i></a></th>
						<th>Icon</th>
						<th>User Settings</th>
						<th>Badges <a id="infobutton" class=" btn-link" type="button" style="margin-bottom: -5px;" onclick="infoAlert('Please see <a href=\'https://tdta.stthomas.edu/documentation/Documentation.php?page=Badges\'>Badge Documentation</a> for more information.');"><i style="color:black;" class="fa fa-question-circle fa-1x" aria-hidden="true"></i></a></th>
						<th>Logs Created</th>
					</tr>
				</thead>
				<tbody>
				<?php
				/*
					The following PHP send a request to the database looking for each user.
					It displays them in descending order by username.
					It will not show users entries with a visibility of -1, which are test accounts.
				*/
					require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

					$output = "";
					$numRows = 0;
					$sql = "
					SELECT `users`.`username`, fname, lname, img_path, phone_number, role, admin_status, numLog 
					FROM users INNER JOIN login USING(username) 
					LEFT JOIN (SELECT username, count(id)as numLog 
								FROM logs 
								WHERE TIMESTAMPDIFF(MONTH, NOW(), date) < 2
								GROUP BY username 
								ORDER BY numLog) 
					as S ON S.username = users.username ";

					$result = mysqli_query($con, $sql);
					if(!$result){
						echo '<div class="alert alert-danger" role="alert"><strong>Error. </strong>';
						echo mysqli_error($con);
						echo '</div>';
					}else{
						if (mysqli_num_rows($result) > 0) {
							// output data of each row
							while($row = mysqli_fetch_assoc($result)) {
								$whoToShow = 0; //Default does not show test accounts or inactive users
								if($_GET['show'] == "inactive"){
									$whoToShow = 0;
								}
								else{
								    $whoToShow = 5;
                                }
								if($row['role'] <= $whoToShow && $row['role'] != -1){
									$numRows += 1;
									$cur_username = $row['username'];
									$fname = $row['fname'];
									$lname = $row['lname'];
									$phonenum = $row['phone_number'];
									$role = $row['role'];
									$admin_status = $row['admin_status'];
									$path = $row['img_path'];
									if(isset($row['numLog'])){
										$numLogs = $row['numLog'];
									}else{
										$numLogs = 0;
									}

									//Shows "None Provided" if the name doesn't show up
									if(strcmp('', $fname)==0){$fname = "---";}
									if(strcmp('', $lname)==0){$lname = "---";}
									if(strcmp('', $phonenum)==0){$phonenum = "---";}

									//Sets which role dropdown option is selected initially
									$inactiveRoleSelected = "";
									$studentRoleSelected = "";
									$employeeRoleSelected = "";
									$alumniRoleSelected = "";
									if($role == 0) {
										$inactiveRoleSelected = "selected";
									} else if($role == 1) {
										$studentRoleSelected = "selected";
									} else if($role == 2) {
										$employeeRoleSelected = "selected";
									}else if($role == 3) {
									    $alumniRoleSelected = "selected";
                                    }

									//Sets which admin status dropdown option is selected initially
									$userStatusSelected = "";
									$superuserStatusSelected = "";
									$adminStatusSelected = "";
									if($admin_status == 1) {
										$userStatusSelected = "selected";
									} else if($admin_status == 2) {
										$superuserStatusSelected = "selected";
									} else if($admin_status == 3) {
										$adminStatusSelected = "selected";
									}

									//Second query that grabs the badges that the user has
									$badges = '<p style="text-align: left;">---</p>';
									$sql2 = "SELECT *
											 FROM badges_held JOIN badges USING(id)
											 WHERE username LIKE '$cur_username'
											 ;";
									$result2 = mysqli_query($con,$sql2);
									if(mysqli_num_rows($result2) != 0) {
										$badges = '<p style="text-align: left;">';
										while($row2 = mysqli_fetch_assoc($result2)) {
											$badgeName = $row2['name'];
											$badgeIcon = $row2['icon'];
											$fixedBadge = str_replace('-5x', '-1x', $badgeIcon);
											$badges .= '
											<span data-toggle="tooltip" title="'.$badgeName.'">
												<i class="'.$fixedBadge.'" aria-hidden="true"> </i>
											</span>';
										}
										$badges .= "</p>";
									}

									echo '
									<tr>
										<th>' . $cur_username . '</th>
										<th>' . $lname . '</th>
										<th>' . $fname . '</th>
										<th>' . $phonenum . '</th>
										<th>
											<div class="form group">
												<select class="form-control" name="'.$cur_username.'RoleSelection">
													<option value="0"'. $inactiveRoleSelected .'>Inactive</option>
													<option value="1"'. $studentRoleSelected .'>Student</option>
													<option value="2"'. $employeeRoleSelected .'>Employee</option>
													<option value="3"'. $alumniRoleSelected .'>Alumni</option>
												</select>
											</div>
										</th>
										<th>
											<div class="form group">
												<select class="form-control" name="'.$cur_username.'StatusSelection">
													<option value="1"'. $userStatusSelected .'>User</option>
													<option value="2"'. $superuserStatusSelected .'>Superuser</option>
													<option value="3"'. $adminStatusSelected .'>Admin</option>
												</select>
											</div>
										</th>
										<th>
											<img src="https://tdta.stthomas.edu/StudentRoster/'.$path.'" height="30px" width="30px">
										</th>
										<th>
											<div class="dropdown">
												<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Settings Options
												<span class="caret"></span></button>
												<ul class="dropdown-menu">
													<li><a href="https://tdta.stthomas.edu/settings/admin/ChangePicture.php?user='.$cur_username.'" target="iFrame"> Remove Picture</a></li>
													<li><a href="https://tdta.stthomas.edu/settings/admin/ChangeBio.php?user='.$cur_username.'" target="iFrame">Set Bio to Default</a></li>
													<li><a href="https://tdta.stthomas.edu/settings/admin/ChangePassword.php?user='.$cur_username.'">Change Password</a></li>
												</ul>
											</div>
										</th>
										<th>
											<p>'.$badges.'</p>
										</th>
										<th>'.$numLogs.'</th>
									</tr>';
								}
							}
						}
						echo '<input type="hidden" name="numRows" value="'.$numRows.'">';

					}
				?>
				</tbody>
			</table>
		<button type="submit" class="btn btn-custom" value="submit">Submit Changes</button>
		</form>
		<!-- The below div is a target for form actions -->
		<div class="iFrame" id="iFrameDiv" style="display: none; padding-top: 5px;">
			<iframe align="left" name="iFrame" width="100%" height="100px" frameBorder="0" marginwidth="0" ></iframe>
		</div>
		</div>
	</div> <!--End div for main section-->

	<div class="col-md-1 text-left">
		<!-- White space on right 1/12th -->
	</div>

  </div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<div class="footer">
<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
?>
</div>
</body>
</html>
