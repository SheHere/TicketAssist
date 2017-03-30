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
			<h1>Full-Time Employee Contacts</h1>
			<p>To create a new entry, click <a href="https://140.209.47.120/contacts/EditContact.php">here</a>.</p>
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
						if (strcmp('', $desk_number) == 0) {
							$desk_number = '---';
						}
						if (strcmp('', $cell_number) == 0) {
							$cell_number = '---';
						}

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
												<th><a href="https://140.209.47.120/contacts/EditContact.php?id=' . $id . '">Edit this entry</a></th>
											</tr>';
					}
					echo $output;
				}
				?>
				</tbody>
			</table>
			<iframe style="padding-top: 3px;" name="iFrame" width="100%" height="1" frameBorder="0"></iframe>


		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
include($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
?>


</body>
</html>
