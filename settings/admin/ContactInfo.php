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
	<title>Contact Table</title>
<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	datatablesHeader();
?>
	<style>
    .footer{
    	padding-top: 30px;
	}
	th {
		font-weight: normal;
	}
	.boldMe {
		font-weight: bold;
	}
	</style>
	<!-- Configures the datatable so that it targets the table, order by descending, sets it to a frame so that we can see the buttons at the bottom without scrolling to them. -->
  <script> 
		$(document).ready(function() {
			$('#contactTable').DataTable({
				"order": [[ 0, "asc" ]],
				scrollY: '60vh',
				scrollCollapge: true,
				columnDefs: [{width: '5%', targets: 0}]
			});
		} );
  </script>
  
  
</head>
<body>
  <!-- Creates the navbar, see file for details and modification -->
<?php
	include $_SERVER["DOCUMENT_ROOT"] . '/includes/navbar.php';
?>
<div class="container-fluid text-center">    
  <div class="row content">

	<div class="col-md-1 text-left"> <!-- EMPTY --> </div>
	<!--
	---- Begin main section, which will call the HTML from the input file
	--->
    <div class="col-md-10 text-left"> 
      
		<h1>Contacts - <a href="#" style="font-size: 75%;">Add new contact here.</a></h1>
		
		<!-- 
		---- The class "sortable" calls .js file that allows the table to be sorted, the class "table" is a Bootstrap
		---- class that formats it nicely, and "table-striped" is a Bootstrap class that makes every-other entry
		---- a gray color so each entry stands out better.
		-->	
		
			<form id="contactForm" action="updateLog.php" method="post" target="iFrame">
			<table id="contactTable" class="display table table-striped"> 
				<thead>
					<tr>
						<th><span class="boldMe">Full Name</span></th>
						<th><span class="boldMe">Location</span></th>
						<th><span class="boldMe">Position</span></th>
						<th><span class="boldMe">Desk Number</span></th>
						<th><span class="boldMe">Cell Number</span></th>
						<th><span class="boldMe">Grouping</span></th>
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
					$sql = "SELECT * FROM contactFTE";
					$result = mysqli_query($con, $sql);
					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
							$id = $row['id'];
							$full_name = $row['full_name'];
							$location = $row['location'];
							$position = $row['position'];
							$desk_number = $row['desk_number'];
							$cell_number = $row['cell_number'];
							$grouping = $row['grouping'];
							//Sets which status dropdown option is selected initially
							$grouping = "";
							if($grouping == 1 || $grouping == 0) {
								$grouping = "Tech Desk";
							} else if($grouping == 2) {
								$grouping = "RRT";
							} else if($grouping == 3) {
								$grouping = "EDT";
							} else if($grouping == 4) {
								$grouping = "Local Tech";
							} else if($grouping == 5) {
								$grouping = "Other";
							} else if($grouping == -1) {
								$grouping = "Hidden";
							}
							/*
							Create table row, populating with information from the logs relation.
							The <span> below forces the log text to be normal, rather than bolded.
							*/
							$output .= '
							<tr>
								<th>'.$full_name.'</th>
								<th>'.$location.'</th>
								<th>' . $position . '</th>
								<th>' . $desk_number . '</span></th>
								<th>' . $cell_number . '</span></th>
								<th>' . $grouping . '</th>
								<th><a href="https://140.209.47.120/settings/admin/EditContact.php?id='.$id.'">Edit this entry</a></th>
							</tr>';
						}
						echo $output;
					}
				?>
				</tbody>
			</table>
			</form>
			<iframe style="padding-top: 3px;" name="iFrame" width="100%" height="1" style="display: none;" frameBorder="0"></iframe>

	</div> <!--End div for main section-->	
  	<div class="col-md-1 text-left"> <!-- EMPTY --> </div>
  </div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->
<!-- Creates the navbar, see file for details and modification -->
<?php
	include $_SERVER["DOCUMENT_ROOT"] . '/includes/footer.php';
?>
</body>
</html>







