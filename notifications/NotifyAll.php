<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); ?>
<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php"); ?>

<!--
<--- Nick Scheel and Chase Ingebritson 2016
<--- 
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Notify All Users</title>
  <meta charset="utf-8">
<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php'); 
	fullHeader();
?>
  <script src="../js/selection.js"></script>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
		tinymce.init({
			browser_spellcheck : true,
			selector:'textarea',
			plugins: 'link image code autolink',
		});
  </script>

</head>
<body>

<!-- Creates the navbar, see file for details and modification -->
<?php
	include $_SERVER["DOCUMENT_ROOT"] . '/includes/navbar.php';
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
		<!-- White space on left 1/12th of the page -->
		</div>
		<div class="col-md-10 text-left">
			<h1>Notify All Users</h1>
			<p>This page can be used to push a notification to all users.</p>
			<form id="notifyForm" action="sendToAll.php" method="post" target="iFrame">
				<div class="form-group">
					<label for="title">Title:</label>
					<input type="text" class="form-control" name="title">
				</div>
				<div class="form-group">
					<label for="message">Message:</label>
					<textarea class="form-control" name="message" rows="5" placeholder="Write the body of the notification here."></textarea>
				</div>
				<button type="submit" class="btn btn-custom">Send Notification</button>
			</form>
			<br>
			<iframe align="left" name="iFrame" id="iFrame" width="500" height="300" frameBorder="0" marginwidth="0" target="_parent" style="display: block"></iframe>


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
