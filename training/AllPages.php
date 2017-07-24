<?php include $_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"; ?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title> All Training Pages </title>
	<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
</head>
<body>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
			<div class="well" style="text-align: center; margin-top: 70px;"><h4><a href="https://tdta.stthomas.edu/training/TrainingHome.php">Training Home</a></h4></div>
			<div class="well" style="text-align: center; margin-top: 10px;"><h4><a href="https://tdta.stthomas.edu/training/NewTrainingGuide.php">New Guide</a></h4></div>
		</div>

		<div class="col-md-10 text-left">
			<h1>Training Guides</h1>
			<hr>
			<?php
			require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
			$sql = "SELECT * FROM training_pages WHERE id > 0 ORDER BY title;";
			$result = mysqli_query($con, $sql);
			$printConcat = "<ul>";
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					$title = html_entity_decode($row['title']);
					$path = html_entity_decode($row['path']);
					$printConcat .=  '
					<li>
						<a href="Page.php?title='.$path.'">'.$title.'</a>
					</li>
					';
				}
				echo $printConcat . '</ul>';
			} else {
				echo "0 results";
			}
			?>
		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
		<br><br><br><br><br>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
?>


</body>
</html>
