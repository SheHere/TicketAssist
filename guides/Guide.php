<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); ?>

<?php
	/*
	 * The following code selects the guide found in the $_GET request via a database query.
	 * The guide is then populated into the page below.
	 */
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	
	//Redirect user if there is no guide to show.
	if(!isset($_GET['guide'])){
		header("Location: GuideIndex.php");
	}
	
	$guide = '';
	$editLink = '<div class="well" style="text-align: center; margin-top: 10px;"><h3><a href="https://140.209.47.120/guides/GuideIndex.php">Guide Index</a></h3></div>';
	$guide = $_GET['guide'];

	$sql = "SELECT * FROM guides WHERE filename LIKE '$guide'";
	$result = mysqli_query($con, $sql);
	if(mysqli_num_rows($result) != 1){
		$title = "Oops!";
		$pagebody = '<h1>Oops!</h1>
		<h3>The guide for "'.$guide.'" does not exist. <a href="https://140.209.47.120/guides/GuideIndex.php">Return to Guide Index.</a></h3>';
	}else{
		if($_SESSION['admin_status'] > 1){
			$editLink .= '<div class="well" style="text-align: center; margin-top: 10px;"><h3><a href="https://140.209.47.120/guides/NewGuide.php?toEdit='.$guide.'">Guide Editor</a></h3></div>';
		}
		$row = mysqli_fetch_assoc($result);
		$title = html_entity_decode($row['guide_name']);
		$pagebody = html_entity_decode($row['body']);
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
		<?php echo $editLink; ?>
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
