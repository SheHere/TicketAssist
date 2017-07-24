<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
	$username = $_SESSION['username'];
	$userstatus = $_SESSION['admin_status'];
?>
<!--
<--- This is the administrator version of logIndex.php, and it allows an admin user to see the
<--- logs of all users.
--->
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Guide Index</title>
	<?php 
		include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php'); 
		datatablesHeader();
	?>

	<script src="../tours/bootstrap-tour-0.11.0/build/js/bootstrap-tour.min.js"></script>
	<script src="../tours/guidesTour.js"></script>
	<script>
	//Configures the datatable so that it targets the table, order by descending, sets it to a frame so that we can see the buttons at the bottom without scrolling to them.
		$(document).ready(function() {
				$('#guideTable').DataTable({
					scrollY: '55vh',
					scrollCollapge: true,
					pageLength: 25,
					columnDefs: [{width: '5%', targets: 0}]
				});
			} );
	</script>
</head>
<body>

<?php
	include '../includes/navbar.php';
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

		<h1 id="guide-header">Guide Index</h1>
		<p>Below is a list of all available guides. Click on the column headers to sort alphabetically. New guides can be added by Superusers and Admins through the <a href="https://tdta.stthomas.edu/guides/NewGuide.php">Guide Submission page</a>.<p>
		<p>Don't see a guide you're looking for? <a href="RequestGuide.php">Request a Guide</a>!</p>
		<!--
		---- The classe "sortable" calls .js file that allows the table to be sorted, the class "table" is a Bootstrap
		---- class that formats it nicely, and "table-striped" is a Bootstrap class that makes every-other entry
		---- a gray color so each entry stands out better.
		-->
		<table id="guideTable" class="table table-striped">
			<thead>
				<tr>
					<!-- Sets table column headers.-->
					<th>Topic</th>
					<th>Guide Name</th>
					<th>Overview</th>
					<?php if($userstatus == 2 || $userstatus == 3){echo "<th>Make Changes</th>";} ?>
				</tr>
			</thead>
			<tbody>
			<!--
			<--- The code below connects to the database, find the guides table, and loops through it. It prints each
			<--- entry into the table, adding table tags around it. It is originally ordered by topic, but can be
			<--- sorted by sorttable.js
			--->
			<?php
				require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');


				$output = "";

				$sql = "SELECT * FROM guides ORDER BY topic";
				$result = mysqli_query($con, $sql);
				if (mysqli_num_rows($result) > 0) {
					// output data of each row
					while($row = mysqli_fetch_assoc($result)) {
						$id = $row['id'];
						$topic = html_entity_decode($row['topic']);
						$guidename = html_entity_decode($row['guide_name']);
						$filename = html_entity_decode($row['filename']);
						$overview = html_entity_decode($row['overview']);
						$adminColumn = "";
						if( $userstatus == 2 || $userstatus == 3){
							$adminColumn = '<th><a href="EditGuide.php?id='. $id . '">Edit this guide</a>';
						}
						$output = $output . '
						<tr>
							<th>' . $topic . '</th>
							<th><a href="Guide.php?id='.$id.'">'.$guidename.'</a></th>
							<th><span style="font-weight:normal;">' . $overview . '</span></th>
							' . $adminColumn . '
						</tr>';
					}
					# $output is an accumilation of each row in the guides database, each tacked onto the end
					# of the previous entry.
					echo $output;
				}
			?>
			</tbody>
		</table>
	</div> <!--End div for main section-->

	<div class="col-md-1 text-left">
		<!-- White space on right 1/12th -->
	</div>

  </div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->
	<button id="start-tour" type="button" class="btn btn-link" onclick="startTour();"><i class="fa fa-question-circle fa-2x" aria-hidden="true"></i></button>
<div class="footer">
<?php
	include '../includes/footer.php';
?>
</div>


</body>
</html>
