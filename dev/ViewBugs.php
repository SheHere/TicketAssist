<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
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
  <title>Submitted Feedback</title>
  
<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php'); 
	datatablesHeader();
?>

	<!-- Configures the datatable so that it targets the table, order by descending, sets it to a frame so that we can see the buttons at the bottom without scrolling to them. -->
	<script>
		$(document).ready(function() {
				$('#bugTable').DataTable({
					scrollY: '55vh',
					scrollCollapge: true,
					columnDefs: [{width: '5%', targets: 0}]
				});
			} );
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

		<h1>Active Bugs</h1>

		<!--
		---- The classe "sortable" calls .js file that allows the table to be sorted, the class "table" is a Bootstrap
		---- class that formats it nicely, and "table-striped" is a Bootstrap class that makes every-other entry
		---- a gray color so each entry stands out better.
		-->
		<form id="bugForm" action="resolveBug.php" method="post" target="iFrame">
			<table id="bugTable" class="display table table-striped">
				<thead>
					<tr>
						<th>Submitted By</th>
						<th>URL</th>
						<th>Notes</th>
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

					$output = "";
					$sql = "SELECT * FROM bugs";
					$result = mysqli_query($con, $sql);
					if(!$result){
						echo '<div class="alert alert-danger" role="alert"><strong>Error. </strong>';
						echo mysqli_error($con);
						echo '</div>';
					}else{
						if (mysqli_num_rows($result) > 0) {
							// output data of each row
							while($row = mysqli_fetch_assoc($result)) {
								if($row['status'] == 1){
									$id = $row['id'];
									$subBy = $row['submitted_by'];
									$url = html_entity_decode ($row['url']);
									$note = html_entity_decode ($row['note']);
									$status = $row['status'];

									$output = '
									<tr>
										<th>' . $subBy . '</th>
										<th><a href="' . $url . '">' . $url . '</a></th>
										<th>' . $note . '</th>
										<th>
											<div class="form group">
												<select class="form-control" name="'.$id.'">
													<option value="1">Open</option>
													<option value="2">Resolved</option>
												</select>
											</div>

										</th>
									</tr>' . $output;
								}
							}
						}
						echo $output;

					}
				?>
				</tbody>
			</table>
		<button type="submit" class="btn btn-custom" value="submit">Submit Changes</button>
		</form>
		<div class="iFrame" id="iFrameDiv">
			<iframe style="display: none;" align="left" name="iFrame" width="100px" height="100px" frameBorder="0" marginwidth="0" ></iframe>
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
