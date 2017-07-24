<?php include $_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"; ?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Training Home</title>
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
		<?php
			if($_SESSION['admin_status'] > 1){
				$print_links = '<div class="well" style="text-align: center; margin-top: 70px;"><h4><a href="NewTrainingGuide.php">New Training Guide</a></h4></div>';
				$print_links .= '<div class="well" style="text-align: center; margin-top: 10px;"><h4><a href="EditHomepage.php">Edit Home Page</a></h4></div>';
				$print_links .= '<div class="well" style="text-align: center; margin-top: 10px;"><h4><a href="AllPages.php">See All Training Guides</a></h4></div>';
				echo $print_links;
			}
		?>
		</div>
		<div class="col-md-10 text-left">
			<?php
			$sql = "SELECT body FROM training_pages WHERE id = -1";
			$result = mysqli_query($con, $sql);
			if(mysqli_num_rows($result) != 1){
				$title = "Oops!";
				$pagebody = '<h1>Oops!</h1>
				<h3>An error has occured. Training Home could not be populated.</h3>';
			}else{
				$row = mysqli_fetch_assoc($result);
				$pagebody = html_entity_decode($row['body']);
			}

			?>
			<h1>Training</h1>
			<hr>
			<?php echo $pagebody; ?>
		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->
<br><br><br><br>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
?>


</body>
</html>
