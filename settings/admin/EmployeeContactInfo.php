<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");
?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Employee Contact Info </title>

	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	datatablesHeader();
	?>
	<!-- Configures the datatable so that it targets the table, order by descending, sets it to a frame so that we can see the buttons at the bottom without scrolling to them. -->
	<script>
        $(document).ready(function () {
            $('#contactTable').DataTable({
                "order": [[0, "asc"]],
                scrollY: '60vh',
                scrollCollapge: true,
                columnDefs: [{width: '5%', targets: 0}]
            });
        });
	</script>
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/alerts.php');
	?>
	<style>

		.footer {
			padding-top: 30px;
		}

		th {
			font-weight: normal;
		}

		.boldMe {
			font-weight: bold;
		}
	</style>
</head>
<body>

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
			<!-- White space on left 1/12th of the page -->
		</div>

		<div class="col-md-10 text-left">
			<br>
			<div id="user_tabs">
				<ul class="nav nav-tabs">
					<li <?php if (strcmp('new', $_GET['tab']) != 0) {
						echo 'class="active"';
					} ?>><a data-toggle="tab" href="#table">Contact Table</a></li>
					<li <?php if (strcmp('new', $_GET['tab']) == 0) {
						echo 'class="active"';
					} ?>><a data-toggle="tab" href="#new">New Contact</a></li>
				</ul>
				<br>
				<div class="tab-content">
					<div id="table" class="tab-pane fade <?php if (strcmp('new', $_GET['tab']) != 0) {
						echo 'in active';
					} ?>">
						<!-- 
						---- The class "sortable" calls .js file that allows the table to be sorted, the class "table" is a Bootstrap
						---- class that formats it nicely, and "table-striped" is a Bootstrap class that makes every-other entry
						---- a gray color so each entry stands out better.
						-->
							<table id="contactTable" class="display table table-striped">
								<thead>
								<tr>
									<th><span class="boldMe">Full Name</span></th>
									<th><span class="boldMe">Location</span></th>
									<th><span class="boldMe">Position</span></th>
									<th><span class="boldMe">Desk Number</span></th>
									<th><span class="boldMe">Cell Number</span></th>
									<th><span class="boldMe">Edit</span></th>
								</tr>
								</thead>
								<tbody>
								<?php
								/*
									The following PHP send a request to the database looking for each log entry that belongs to the current user.
									It displays them in descending order by ID, which is also by most recent. 
									It will not show log entries with a visibility of 0, ones that have been "deleted".
								*/
								require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

								$username = $_SESSION['username'];
								$output = "";
								$sql = "SELECT * FROM contactFTE;";
								$result = mysqli_query($con, $sql);
								if (mysqli_num_rows($result) > 0) {
									// output data of each row
									while ($row = mysqli_fetch_assoc($result)) {
										$id = $row['id'];
										$full_name = $row['full_name'];
										$location = $row['location'];
										$position = $row['position'];
										$desk_number = $row['desk_number'];
										$cell_number = $row['cell_number'];
										$grouping = $row['grouping'];

										/*
										Create table row, populating with information from the logs relation.
										The <span> below forces the log text to be normal, rather than bolded.
										*/
										$output .= '
											<tr>
												<th>' . $full_name . '</th>
												<th>' . $location . '</th>
												<th>' . $position . '</th>
												<th>' . $desk_number . '</span></th>
												<th>' . $cell_number . '</span></th>
												<th><a href="https://tdta.stthomas.edu/settings/admin/EditContact.php?id=' . $id . '">Edit this entry</a></th>
											</tr>';
									}
									echo $output;
								}
								?>
								</tbody>
							</table>
						</form>
						<iframe style="padding-top: 3px;" name="iFrame" width="100%" height="1" style="display: none;"
								frameBorder="0"></iframe>
					</div>
					<div id="new" class="tab-pane fade<?php if (strcmp('new', $_GET['tab']) == 0) {
						echo 'in active';
					} ?>">
						<form id="contactUpdateForm" action="modifyContactEntry.php" method="post"
							  target="contactiFrame">
							<div class="form-group">
								<label for="contactFullName">Full Name:</label>
								<input type="text" class="form-control" name="contactFullName">
							</div>
							<div class="form-group">
								<label for="location">Location:</label>
								<input type="text" class="form-control" name="location">
							</div>
							<div class="form-group">
								<label for="position">Position:</label>
								<input type="text" class="form-control" name="position">
							</div>
							<div class="form-group">
								<label for="dnumber">Desk Number:</label>
								<input type="text" class="form-control" name="dnumber">
							</div>
							<div class="form-group">
								<label for="cnumber">Cell Number:</label>
								<input type="text" class="form-control" name="cnumber">
							</div>

							<?php
							$group_sql = "SELECT * FROM `contact_groups` ORDER BY ordering;";
							$group_result = mysqli_query($con, $group_sql);
							$options = '';
							if(mysqli_num_rows($group_result) > 0){
								while($group_row = mysqli_fetch_assoc($group_result)){
									$options .= '
									<option value="'.$group_row['id'].'">'.$group_row['group_name'].'</option>';
								}
							}
							?>
							<div class="form group">
								<label for="selectGrouping">Group</label>
								<select class="form-control" name="selectGrouping" required>
									<option value="">----</option>
									<?php echo $options; ?>
									<option value="-1">Hidden</option>
									<option value="-2">Removed</option>
								</select>
							</div>
							<input type="hidden" name="contactID" value="<?php echo $id; ?>">
							<br>
							<button type="submit" class="btn btn-custom">Submit</button>
						</form>
						<br>
						<iframe align="left" name="contactiFrame" id="contactiFrame" width="500" height="300"
								frameBorder="0" marginwidth="0" style="display: block;"></iframe>
					</div>
				</div>
			</div>


		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
?>


</body>
</html>
