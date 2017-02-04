<?php 
	include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/auth.php"); 
	include 'badge_functions.php';
	require($_SERVER["DOCUMENT_ROOT"] . '/loginutils/connectdb.php');
	
	$usrstatus = $_SESSION['admin_status'];
?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Badge Index</title>
	<?php include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php'); 
	datatablesHeader();?>
 	
	<link rel="stylesheet" href="../styles/badges.css">
	<!-- Configures the datatable so that it targets the table, order by descending, sets it to a frame so that we can see the buttons at the bottom without scrolling to them. -->
  	<script> 
		// The following initializes the datatable, a 3rd party script that augments HTML tables.
		$(document).ready(function() {
			//Targets table with id badgeTable
			$('#badgeTable').DataTable({
				scrollY: '55vh',
				scrollCollapge: true,
				//Default number of entries set to 25 from original default of 10
				pageLength: 25,
				columnDefs: [{width: '5%', targets: 0}]
			});
		});
		
		//The following initializes a custom SweetAlert to have the user confirm when deleting a badge
		function deletePrompt(id) {
			swal({
				  title: "Are you sure?",
				  text: "This will delete the badge and remove it from all users! ",
				  type: "warning",
				  showCancelButton: true,
				  confirmButtonColor: "#DD6B55",
				  confirmButtonText: "Yes, delete it!",
				  closeOnConfirm: false
				},
				function(){
				  swal("Deleted!", "This badge has been deleted.", "success");
				  document.getElementById("form" + id).submit();
				  location.reload(true);
				});
		}
	</script>
</head>
<body>
	<?php
		include($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
	?>
	<div class="container-fluid">
		<div class="col-md-1 col-sm-0"></div>
		<div class="col-md-10 col-sm-12">
			<div class="row">
				<div class="col-md-6 col-sm-6 col-xs-6 header_text">
					<h1>Badge Index</h1>
				</div>
			</div>
			<div class="row">
				<table id="badgeTable" class="table table-striped" width="100%">
					<thead>
						<tr>
							<th>Icon</th>
							<th>Name</th>
							<th>Prerequisites</th>
							<th>Users with this badge</th>
							
							<?php
							// If admin, add columns for editing the badge and deleting the badge
							if ($usrstatus == 3) {
								echo '<th style="text-align:right">Edit this badge</th>';
								echo '<th style="text-align:right">Delete this badge</th>';
							}
							?>
						</tr>
					</thead>
					<tbody>
						<?php populateBadges(); ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-1 col-sm-0"></div>
		
		<?php
		// If an admin user, show "Create a new badge" button
		if($usrstatus == 3) {
			echo '
				<div class="col-md-12 col-sm-12">
					<a href="badge_manager.php" role="button" class="btn btn-block btn-custom">Create New Badge</a>
				</div>
			';
		}
		?>
					<iframe src="#" class="form_target" id="form_target" name="form_target" style="display: none;"></iframe>
	</div>
	<div class="footer">
	<?php
		include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php"); 
	?>
	</div>
</body>
</html>