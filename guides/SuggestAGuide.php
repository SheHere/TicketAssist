<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Suggest A Guide </title>
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

			<h1>Suggest a Guide</h1>
			<p><em>* denotes required field.</em></p>
			<form id="guideForm" action="sendSuggestion.php" method="post" target="iFrame">
				<div class="form-group">
					<label for="title">Topic: *</label>
					<input class="form-control" name="topic" placeholder="How to [blank]" required>
				</div>
				<div class="form-group">
					<label for="body">Additional Comments:</label>
					<textarea class="form-control" name="body" rows="10"></textarea>
				</div>
				<div class="checkbox">
					<label><input type="checkbox" required value="">* I have made sure that a guide does not already exist for this topic.</label>
				</div>
				<button type="submit" form="guideForm" class="btn btn-custom">Submit</button>



			</form>
			<br>
			<iframe src="#" align="left" name="iFrame" width="100%" height="100" frameBorder="0" marginwidth="0" style="display: none;"></iframe>
		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
?>

<script>
    function submitDelete() {
        swal({
                title: "Are you sure?",
                text: "You will not be able to recover this guide!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: true
            },
            function(){
                document.getElementById("delForm").submit();
                document.getElementById('iFrame').contentWindow.location.reload();
            });
    }
</script>
</body>
</html>
