<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title> New Encyclopedia Entry </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="../../styles/assistant.css">
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
		tinymce.init({ 
			selector:'textarea',
			plugins: 'link',
		});
  </script>
</head>
<body>

<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
?>
  
<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left"> 
		<!-- White space on left 1/12th of the page -->
		</div>
	 
		<div class="col-md-10 text-left"> 
		
			<h1>Create New Entry</h1>
			<p>This form will allow you to submmit a new term to the encyclopedia. After submission, your term must be approved by a Admin or Superuser before being visible in the encyclopedia.</p>
			<p><em>* denotes required field.</em></p>
			<form id="termForm" action="sendTerm.php" method="post" target="iFrame">
				<div class="form-group">
					<label for="term">Term: *</label>
					<input class="form-control" name="term" required>
				</div>
				<div class="form-group">
					<label for="topicselect">Topic: *</label>
					<select class="form-control" id="topicselect" name="topicselect">
						<option value="">----</option>
						<option value="Accounts">Accounts</option>
						<option value="Audio / Visual">Audio / Visual</option>
						<option value="Email">Email</option>
						<option value="Harware">Hardware</option>
						<option value="Networking">Networking</option>
						<option value="Printing">Printing</option>
						<option value="Software">Software</option>
						<option value="Tech Desk Resources">Tech Desk Resources</option>
						<option value="Web">Web</option>
					</select>
				</div>
				<div class="form-group">
					<label for="description">Description: *</label>
					<textarea class="form-control" name="description" rows="5" placeholder="Define your term here." ></textarea>
				</div>
				<div class="form-group">
					<label for="guide">Associated Guide URL:</label>
					<input class="form-control" name="guide" placeholder="http://140.209.47.120/guides/allguides/GuideGuide.php">
				</div>
				<br>
				<p><em>Please provide at least one keyword that is associated with your provided term.</em></p>
				<div class="form-group">
					<label for="keyword1">Keyword 1:</label>
					<input class="form-control" name="keyword1" required>
				</div>
				<div class="form-group">
					<label for="keyword2">Keyword 2:</label>
					<input class="form-control" name="keyword2">
				</div>
				<div class="form-group">
					<label for="keyword3">Keyword 3:</label>
					<input class="form-control" name="keyword3">
				</div>
				
				<button type="submit" class="btn btn-default">Submit</button>
			</form>
			<br>
			<iframe align="left" name="iFrame" width="100%" height="100" frameBorder="0" marginwidth="0"></iframe>	
			
		</div> <!--End div for main section-->
		  
		<div class="col-md-1 text-left"> 
			<!-- White space on right 1/12th of the page  -->
		</div>	
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
	include '../includes/footer.php';
?>


</body>
</html>
