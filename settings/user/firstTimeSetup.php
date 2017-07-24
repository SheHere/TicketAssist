<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$username = $_SESSION['username'];
	$query = "UPDATE `login` SET `new_user` = 1 WHERE `login`.`username` = '$username';";
	$result = mysqli_query($con,$query) or die(mysql_error());
	if(!$result){
		echo "Error.";
	}
	$query2 = "SELECT fname, lname FROM `users` WHERE `username` LIKE '$username';";
	$result2 = mysqli_query($con, $query2);
	$row = mysqli_fetch_assoc($result2);
	$fname = $row['fname'];
	$lname = $row['lname'];
?>

<!--
<--- Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>  </title>
	<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <?php
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/alerts.php';
?>
  <script>
		tinymce.init({
			selector:'textarea',
			plugins: 'link',
		});
  </script>
  <style>
  	body {
  		background-image: url("http://66.media.tumblr.com/tumblr_mbcfjxBqQo1qd7gwho6_100.gif");
  		background-size: 100% 100%;
  	}
  </style>
</head>
<body>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
		<!-- White space on left 1/12th of the page -->
		</div>

		<div class="col-md-10 text-left">

			<h1>Welcome!</h1>
			<p>
				In your bio, please include the following information:
				<ul>
					<li>Your name (ex. Hello! My name is John Smith.)</li>
					<li>Your year (ex. I am a Sophomore. OR I am a second year student.)</li>
					<li>What you are studying (ex. I am majoring in Underwater Basket Weaving.)</li>
					<li>Two hobbies (ex. I love drinking water and studying!)</li>
				</ul>
				Please note that a tutorial can be found in the bottom right corner of the home page.
			</p>
			<form id="newUserForm" action="updateUsers.php" method="post" target="iFrame">
				<div class="form-group">
					<label for="author">First Name:</label>
					<input class="form-control" name="fname" placeholder="John" value="<?php echo $fname; ?>">
				</div>
				<div class="form-group">
					<label for="title">Last Name:</label>
					<input class="form-control" name="lname" placeholder="Smith" value="<?php echo $lname; ?>">
				</div>
				<div class="form-group">
					<label for="message">Bio:</label>
					<textarea class="form-control" name="bio" rows="5" maxlength="300" placeholder="Write your bio here!"></textarea>
				</div>
				<button type="submit" class="btn btn-custom">Submit</button>
			</form>
			<br>
			<iframe align="left" name="iFrame" width="300px" height="100px" frameBorder="0" marginwidth="0"></iframe>

		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
?>

</body>
</html>
