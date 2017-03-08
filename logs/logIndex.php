<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); ?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Log Index</title>
	<?php include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	datatablesHeader(); ?>
  
  
  <style>
    .footer{
    	padding-top: 30px;
	}
  </style>
  <!-- Configures the datatable so that it targets the table, order by descending, sets it to a frame so that we can see the buttons at the bottom without scrolling to them. -->
  <script> 
		$(document).ready(function() {
				$('#logTable').DataTable({
					"order": [[ 0, "desc" ]],
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

	<div class="col-md-1 text-left"> </div>
	<!--
	---- Begin main section, which will call the HTML from the input file
	--->
    <div class="col-md-10 text-left"> 
      
		<h1>Log Index <input type="button" class="btn btn-default" value="Refresh Table" onClick="window.location.reload(true)"></h1>
		<?php
			if($_SESSION['admin_status'] == 3){
				echo "<p>As an admin user, you have access to the logs of all users.</p>";
			}
		?>
		
		<!-- 
		---- The classe "sortable" calls .js file that allows the table to be sorted, the class "table" is a Bootstrap
		---- class that formats it nicely, and "table-striped" is a Bootstrap class that makes every-other entry
		---- a gray color so each entry stands out better.
		-->	
		
			<form id="minilogForm" action="updateLog.php" method="post" target="iFrame">
			<table id="logTable" class="display table table-striped"> 
				<thead>
					<tr>
						<th>ID</th>
						<th>Author</th>
						<th>Date Created</th>
						<th>Log</th>
						<th>Status</th>
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
					if($_SESSION['admin_status'] == 3){
						$sql = "SELECT * FROM logs";
					}else{
						$sql = "SELECT * FROM logs WHERE username LIKE '$username'";
					}
					$result = mysqli_query($con, $sql);
					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
								$id = $row['id'];
								$author = $row['username'];
								$date = $row['date'];
								$log_text = $row['log_text'];
								$current_status = $row['current_status'];
								//Sets which status dropdown option is selected initially
								$openSelected = "";
								$flaggedSelected = "";
								$resolvedSelected = "";
								if($current_status == 1) {
									$openSelected = "selected";
								}else if($current_status == 3 || $current_status == 2) /*Temporary; resolved as value 3 should be phased out soon, becoming value 2 */{
									$resolvedSelected = "selected";
								}
								if($current_status != 0) {
									/*
									Create table row, populating with information from the logs relation.
									The <span> below forces the log text to be normal, rather than bolded.
									*/
									$output = '
									<tr>
										<th>'.$id.'</th>
										<th>'.$author.'</th>
										<th>' . $date . '</th>
										<th><span style="font-weight: normal;">' . $log_text . '</span></th>
										<th>
											<div class="form group">
												<select class="form-control" name="select'.$id.'" onchange="submitFunction(); ">
													<option value="1"'. $openSelected .'>Open</option>
													<option value="2"'. $resolvedSelected .'>Resolved</option>
												</select>
											</div>
										</th>
									</tr>' . $output;
								}
						}
						echo $output;
					}
				?>
				</tbody>
			</table>
			</form>
			<iframe style="padding-top: 3px;" name="iFrame" width="100%" height="1" style="display: none;" frameBorder="0"></iframe>

		</div>
	</div> <!--End div for main section-->	
  	<div class="col-md-1 text-left"> </div>
  </div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->
<!-- Creates the navbar, see file for details and modification -->
<?php
	include $_SERVER["DOCUMENT_ROOT"] . '/includes/footer.php';
?>
  <script>
		function submitFunction() {
		document.getElementById("minilogForm").submit();
	}
  </script>
</body>
</html>







