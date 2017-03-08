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
				$('#logTable').DataTable({
					"order": [[ 0, "desc" ]],
					scrollY: '60vh',
					scrollX: 'false',
					paging: false,
					searching: false,
					
					scrollCollapge: true,
					columnDefs: [{width: '5%', targets: 0}]
				});
			} );
  </script>
  <base target="_parent">
  
</head>
<body>
  
<div class="container-fluid text-center">    
  <div class="row content">

	<!--
	---- Begin main section, which will call the HTML from the input file
	--->
    <div class="col-lg-12 text-left"> 
      
		<h1>Unresolved Logs <input type="button" class="btn btn-default" value="Refresh Table" onClick="window.location.reload(true)"></h1>
		<p><a href="https://140.209.47.120/logs/logIndex.php">See all logs here.</a><p>
		
		<!-- 
		---- The classe "sortable" calls .js file that allows the table to be sorted, the class "table" is a Bootstrap
		---- class that formats it nicely, and "table-striped" is a Bootstrap class that makes every-other entry
		---- a gray color so each entry stands out better.
		-->	
		
			<form id="minilogForm" action="updateLog.php" method="post" target="iFrame">
			<table id="logTable" class="display table table-striped"> 
				<thead>
					<tr>
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
					$sql = "SELECT * FROM logs WHERE username LIKE '$username'";
					$result = mysqli_query($con, $sql);
					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
								$id = $row['id'];
								$date = $row['date'];
								$log_text = $row['log_text'];
								$current_status = $row['current_status'];
								$selectedOpen = '';
								$selectedFlagged = '';
								if($current_status == 1){$selectedOpen = 'selected';}
								if ($current_status == 1) {
									/*
									Create table row, populating with information from the logs relation.
									The <span> below forces the log text to be normal, rather than bolded.
									*/
									$output = '
									<tr>
										<th>' . $date . '</th>
										<th><span style="font-weight: normal;">' . $log_text . '</span></th>
										<th>
											<div class="form group">
												<select class="form-control" name="select'.$id.'" onchange="submitFunction(); ">
													<option value="1"'. $selectedOpen .'>In Progress</option>
													<option value="2">Ticket Created</option>
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


	</div> <!--End div for main section-->	
  	
  </div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

  <script>
		function submitFunction() {
		document.getElementById("minilogForm").submit();
	}
  </script>
</body>
</html>







