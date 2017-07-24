<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html>
<head>
	<?php 
		include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
		reducedHeader();
	?>
	<style>
		body {
			padding-right: 5px;
		}
		h2 {
			margin: 0px;
			padding: 0px;
		}
	</style>
	<base target="_parent">
</head>
<body>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

	$sql = "SELECT * FROM announcements";
	$result = mysqli_query($con, $sql);
	$printConcat = "";
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
			$title = html_entity_decode($row['title']);
			$date = $row['date'];
			$author = html_entity_decode($row['author']);
			$message = html_entity_decode($row['message']);
			$vis = $row['visibility'];
			if($vis >0){
				$printConcat =  '
					<div class="panel panel-default">
					<div class="panel-body">
					<h2>' . $title . '</h2>
					<em>Published ' . $date . ' by ' . $author . '</em><br>
					<p>' . $message . '</p>
					</div>
					</div>' . $printConcat;
			}
		}
	} else {
		echo "0 results";
	}
?>
<div class="container">
	<?php if($_SESSION['admin_status'] > 2){
		echo '<div class="row" style="margin-bottom: 15px;">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
		<div class="btn-group" role="group">
			<a href="https://tdta.stthomas.edu/announcements/Announcements.php" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> - New Announcement</a> 
		</div>
		<div class="btn-group" role="group">
			<a href="https://tdta.stthomas.edu/announcements/Announcements.php?tab=remove" class="btn btn-default"><i style="color:black;" class="fa fa-bomb fa-1x" aria-hidden="true"></i> - Delete Announcement</a>
		</div>
	</div>
</div>';} ?>
	<div class="row">
		<!-- Begin to_print -->
		<?php echo $printConcat; ?>
		<!-- End to_print -->
	</div>
</div>
</body>
</html>
