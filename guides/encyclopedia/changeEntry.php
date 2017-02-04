<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title> Edit Entry </title>
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

<?php include($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php'); ?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left"> 
		<!-- White space on left 1/12th of the page -->
		</div>
	 
		<div class="col-md-10 text-left"> 
			<?php	
				require ($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
				
				$toEdit = $_POST['toEdit'];
				
				require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
					$username = $_SESSION['username'];
					$output = "";
					$sql = "SELECT * FROM encyclopedia";
					$result = mysqli_query($con, $sql);
					
					$keyword1 = '';
					$keyword2 = '';
					$keyword3 = '';
					$keyword4 = '';
					
					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
							$id = $row['count'];
							if($id == $toEdit){
								$author = $row['author'];
								$term = $row['vocab_term'];
								$topic = $row['topic'];
								$description = $row['description'];
								$guide = $row['guide'];
								$keyword1 = $row['keyword1'];
								$keyword2 = $row['keyword2'];
								$keyword3 = $row['keyword3'];
								if(strcmp('', $keyword1) != 0){$keywords .= $keyword1;}
								if(strcmp('', $keyword2) != 0){$keywords .= ', ' . $keyword2;}
								if(strcmp('', $keyword3) != 0){$keywords .= ', ' . $keyword3;}
								//Status: 0 = hidden, 1=pending admin approval, 2=approved
								$status = $row['status'];

							}
						}
				echo '<h1>Edit Entry</h1>
				<p>This form will allow you to edit a submitted term for the encyclopedia. Make any changes neccessary, and then set the status to "Approved".</p>
				<p><em>* denotes required field.</em></p>
				<form id="termForm" action="sendTerm.php" method="post" target="iFrame">
					<div class="form-group">
						<label for="author">Author: *</label>
						<input class="form-control" name="author" value="' . $author . '" disabled>
					</div>
					<div class="form-group">
						<label for="term">Term: *</label>
						<input class="form-control" name="term" value="' . $term . '" required>
					</div>
					<div class="form-group">
						<label for="topicselect">Topic: *</label>
						<select required class="form-control" id="topicselect" name="topicselect">
							<option value="">----</option>
							<option value="Accounts">Accounts</option>
							<option value="Audio / Visual">Audio / Visual</option>
							<option value="Email" >Email</option>
							<option value="Hardware">Hardware</option>
							<option value="Networking">Networking</option>
							<option value="Printing">Printing</option>
							<option value="Software">Software</option>
							<option value="Tech Desk Resources">Tech Desk Resources</option>
							<option value="Web">Web</option>
						</select>
					</div>
					<div class="form-group">
						<label for="description">Description: *</label>
						<textarea class="form-control" name="description" rows="5" required >' . $description. '</textarea>
					</div>
					<div class="form-group">
						<label for="guide">Associated Guide URL:</label>
						<input class="form-control" name="guide" value="' . $guide . '">
					</div>
					<br>
					<p><em>Please provide at least one keyword that is associated with your provided term.</em></p>
					<div class="form-group">
						<label for="keyword1">Keyword 1:</label>
						<input class="form-control" name="keyword1" value="' . $keyword1 . '" required>
					</div>
					<div class="form-group">
						<label for="keyword2">Keyword 2:</label>
						<input class="form-control" name="keyword2" value="' . $keyword2 . '">
					</div>
					<div class="form-group">
						<label for="keyword3">Keyword 3:</label>
						<input class="form-control" name="keyword3" value="' . $keyword3 . '">
					</div>
					<div class="form-group">
						<label for="statusselect">Status: *</label>
						<select required class="form-control" id="statusselect" name="statusselect">
							<option value="">----</option>
							<option value="denied">Denied</option>
							<option value="pending">Pending</option>
							<option value="flagged">Flagged</option>
							<option value="approved">Approved</option>
						</select>
					</div>
					
					<button type="submit" class="btn btn-default">Submit</button>
				</form>
				<br>
				<iframe align="left" name="iFrame" width="100%" height="100" frameBorder="0" marginwidth="0"></iframe>	
				'; 
				} else {echo '
					<div class="alert alert-danger" role="alert"><strong>Oops!</strong> Something went wrong. <a href="http://140.209.47.120/guides/encyclopedia/EntryApproval.php">Go back.</a></div>
					';}
			?>
		</div> <!--End div for main section-->
		  
		<div class="col-md-1 text-left"> 
			<!-- White space on right 1/12th of the page  -->
		</div>	
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->


<div class="footer">
<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
?>
</div>

</body>
</html>