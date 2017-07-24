<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Guide Editor </title>
	<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
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
			<h1>New Guide</h1>
			<p>This form will allow you to create a new guide that will be seen in the Guide Index. Please set a Title and determine its Topic and then click "Continue".</p>
			<form id="guideForm" action="sendGuide.php" method="post" target="iFrame">
				<div class="form-group">
					<label for="title">Title: *</label>
					<input class="form-control" name="title" placeholder="Writing an Example Guide" required>
				</div>
				<div class="form-group">
					<label for="topicselect">Topic: *</label>
					<select required class="form-control" id="topicselect" name="topicselect">
						<option value="">----</option>
						<option value="Accounts" <?php if(strcmp($editTopic, "Accounts") == 0){echo "selected";} ?> >Accounts</option>
						<option value="Audio / Visual"<?php if(strcmp($editTopic, "Audio / Visual") == 0){echo "selected";} ?>>Audio / Visual</option>
						<option value="Email"<?php if(strcmp($editTopic, "Email") == 0){echo "selected";} ?>>Email</option>
						<option value="Hardware"<?php if(strcmp($editTopic, "Hardware") == 0){echo "selected";} ?>>Hardware</option>
						<option value="Networking"<?php if(strcmp($editTopic, "Networking") == 0){echo "selected";} ?>>Networking</option>
						<option value="Printing"<?php if(strcmp($editTopic, "Printing") == 0){echo "selected";} ?>>Printing</option>
						<option value="Software"<?php if(strcmp($editTopic, "Software") == 0){echo "selected";} ?>>Software</option>
						<option value="Tech Desk Resources"<?php if(strcmp($editTopic, "Tech Desk Resources") == 0){echo "selected";} ?>>Tech Desk Resources</option>
						<option value="Web">Web</option>
					</select>
				</div>
				<input type="hidden" name="guide_id" value="-1">
				<button type="submit" class="btn btn-custom">Continue</button>
			</form>
			<iframe src="#" align="left" name="iFrame" width="100%" height="100" frameBorder="0" marginwidth="0" style="display: none;"></iframe>
			<br><br><br><br><br>
		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->
<script>
	// Triggered when guideForm is submited
    $("#guideForm").submit(function(e){
        var frm = $("#guideForm");
        // JQuery AJAX request
        $.ajax({
            // Set variables to what is set in form tags
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function(data){
                // On error, call SweetAlert
                if( data == 'error'){
                    swal({
                        title: "Oops!",
                        text: "An error occured. Please make sure that the guide name is unique and try again.",
                        type: "error",
                        html: true
                    });
                }else{
                    // On success, redirect to page given by sendGuide.php
                    window.location.href = data;
                }
            }
        })
        e.preventDefault();
    });
</script>
<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
?>
</body>
</html>
