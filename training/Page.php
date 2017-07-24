<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
/*
 * The following code selects the guide found in the $_GET request via a database query.
 * The guide is then populated into the page below.
 */
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

//Redirect user if there is no guide to show.
if(isset($_GET['title']) || isset($_GET['id'])){
	if(isset($_GET['id'])) {
		$guide_id = $_GET['id'];
		$sql = "SELECT * FROM training_pages WHERE id = $guide_id;";
	}
	else if(isset($_GET['title'])){
		$guide_title = $_GET['title'];
		$sql = "SELECT * FROM training_pages WHERE path LIKE '$guide_title';";
	}
	$result = mysqli_query($con, $sql);
	if(!result){
		$alert = "Database error.";
	}else{
		if(mysqli_num_rows($result) != 1){
			$title = "Oops!";
			$pagebody = '<h1>Oops!</h1>
		<h3>The page: "'.$path.'" does not exist.</h3>
		<h4><a href="https://tdta.stthomas.edu/training/TrainingHome.php">Return to Training Home</a></h4>
		<h4><a href="https://tdta.stthomas.edu/training/NewTrainingGuide.php">Write a new guide</a></h4>
		<h4><a href="https://tdta.stthomas.edu/training/AllPages.php">See All Training Guides</a></h4>';
		}else{
			$row = mysqli_fetch_assoc($result);
			$id = $row['id'];
			$title = html_entity_decode($row['title']);
			$pagebody = html_entity_decode($row['body']);
			$links = '<div class="well" style="text-align: center; margin-top: 70px;"><h4><a href="https://tdta.stthomas.edu/training/TrainingHome.php">Training Home</a></h4></div>
<div class="well" style="text-align: center; margin-top: 10px;"><h4><a href="https://tdta.stthomas.edu/training/NewTrainingGuide.php">New Guide</a></h4></div>';
			if($_SESSION['admin_status'] > 1){
				$links .= '<div class="well" style="text-align: center; margin-top: 10px;"><h4><a href="https://tdta.stthomas.edu/training/EditTrainingGuide.php?id='.$id.'">Edit This Guide</a></h4></div>';
			}
		}
	}
// If neither $_GETs are set, throw error
}else{
	$alert = "Training Guide not found.";
}
if(isset($error)){
	$pagebody = '<h1>Oops!</h1>
		<h3>Error: ' . $error . '</h3>
		<h4><a href="https://tdta.stthomas.edu/training/TrainingHome.php">Return to Training Home</a></h4>
		<h4><a href="https://tdta.stthomas.edu/training/EditTrainingGuide.php">Write a new guide</a></h4>
		<h4><a href="https://tdta.stthomas.edu/training/AllPages.php">See All Training Guides</a></h4>';
}
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title> <?php echo $title; ?> </title>
	<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
	<link rel="stylesheet" href="../styles/guidestyle.css">


</head>
<body>

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
			<?php echo $links; ?>
		</div>

		<div class="col-md-10 text-left">

			<?php echo $pagebody; ?>

			<br><br><br><br><br>
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
