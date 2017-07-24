<?php
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
	<title> New Training Guide </title>
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
			<h1>New Training Guide</h1>
			<form id="guideForm" action="sendTrGuide.php" method="post" target="iFrame">
				<div class="form-group">
					<label for="title">Title: *</label>
					<input class="form-control" name="title" placeholder="How to Tech Desk" required>
				</div>
				<input type="hidden" name="guide_id" value="-1">
				<button type="submit" class="btn btn-custom">Continue</button>
				<a href="TrainingHome.php" class="btn btn-danger">Cancel and Return</a>
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
