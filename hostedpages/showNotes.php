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
</head>
<body>
	<?php
		require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

		$username = $_SESSION['username'];

		/*
			The following code perform a SQL query that grabs the current user's notes.
			It is then outputed into the text box s
		*/
		$sql = "SELECT `notes`
				FROM `users`
				WHERE `username` LIKE '$username';";
		$result = mysqli_query($con, $sql);
		if (!$result) {
			echo '<div class="alert alert-danger" role="alert"><strong>Oops!</strong> Something went wrong.<br>SQL Error: ';
			echo mysqli_error($con);
			echo '</div>';
		}else{
			$ret = mysqli_fetch_assoc($result);
			//Get info from users
			$cur_notes = $ret['notes'];
		}
	?>
	<form action="updateNotes.php" method="POST" target="iFrame" id="noteform">
		<div class="form-group">
			<div class="row">
				<div class="col-xs-6">
						<p style="margin-top: 10px;"><b>Notes:</b><p>
				</div>
				<div class="col-xs-6 text-right">
					<button id="infobutton" class="btn btn-link" type="button" onclick="parent.infoAlert('Write whatever you want here, and it will automatically save after you are done typing!');"><i style="color:black;" class="fa fa-question-circle fa-2x" aria-hidden="true"></i></button>
				</div>
			</div>	
			<textarea id="myInput" class="form-control" name="notes_text" rows="25" maxlength="500" ><?php echo $cur_notes; ?></textarea>
		</div>
	</form>
	<iframe style="padding-top: 3px;" name="iFrame" width="100%" height="50px" frameBorder="0" ></iframe>
	<script>
		//setup before functions
		var typingTimer;                //timer identifier
		var doneTypingInterval = 1000;  //time in ms (5 seconds)

		//on keyup, start the countdown
		$('#myInput').keyup(function(){
			clearTimeout(typingTimer);
			if ($('#myInput').val()) {
				typingTimer = setTimeout(doneTyping, doneTypingInterval);
			}
		});

		//user is "finished typing," do something
		function doneTyping () {
			document.getElementById("noteform").submit();
		}
	</script>
</body>
</html>
