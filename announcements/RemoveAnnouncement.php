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
<html>
<head>
  <title> Remove Announcement </title>
<?php 
		include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
		reducedHeader();
	?>
</head>
<body>

<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/includes/navbar.php");
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
		<!-- White space on left 1/12th of the page -->
		</div>

		<div class="col-md-10 text-left">

			<h1>Remove Entry</h1>
			<p>This form will allow you to remove an announcement so that it no longer shows on the front page.</p>
			<p><strong>To create a new announcement, please go <a href="NewAnnouncement.php">here</a>.</strong></p>
			<p>This page should only be accessible by admin users.<p>
			<form id="announcementForm" action="deleteAnnounce.php" method="post" target="removeiFrame">
				<table class="sortable table table-striped">
				<thead>
					<tr>
						<th>Select</th>
						<th>ID</th>
						<th>Date Created</th>
						<th>Author</th>
						<th>Title</th>
					</tr>
				</thead>
				<tbody>
				<?php
					require($_SERVER['DOCUMENT_ROOT'] . "/loginutils/connectdb.php");

					$output = "";

					$sql = "SELECT * FROM `announcements`";
					$result = mysqli_query($con, $sql);
					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
							if($row['visibility']==1){
							$count = $row['count'];
							$date = $row['date'];
							$author = html_entity_decode($row['author']);
							$title = html_entity_decode($row['title']);

							$output =
							'<tr>
								<th>
									<div class="checkbox">
										<label class="checkbox-inline">
											<input type="checkbox" name="toRemove[]" value="' . $count . '">
										</label>
									</div>
								</th>
								<th>' . $count . '</th>
								<th>' . $date . '</th>
								<th>' . $author . '</th>
								<th>' . $title . '</th>
							</tr>'
							. $output;
							}
						}
						echo $output;
					}
				?>
				</tbody>
				</table>

				<button type="submit" class="btn btn-default" value="submit">Delete Selected</button>
			</form>
			<br>
			<iframe align="left" name="removeiFrame" width="100%" height="500" frameBorder="0" marginwidth="0"></iframe>

		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
?>


</body>
</html>
