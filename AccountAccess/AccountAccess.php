<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title> Title </title>
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
	<script src="../third-party-packages/MaskedInput.js" type="text/javascript"></script>
	<style>
		.btn-custom {
			margin-top: 10px;
			margin-bottom: 25px;
		}
		.footer_text {
			position: relative;
			bottom: 0;
			z-index: 2;
		}
	</style>

</head>
<body>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
			<!-- White space on left 1/12th of the page -->
		</div>

		<div class="col-md-10 text-left">
			<div class="row">
				<div class="col-xs-6">
					<h1>Permissions Request Form</h1>
					<form id="accountForm" action="PermissionChangeOutput.php" class="input-append" method="POST">
						<!-- Begin Department Information section -->
						<legend>Department Information</legend>
						<div class="form-group">
							<label for="sel1">Select Department:</label>
							<select class="form-control" id="typeselect">
								<option value="">---</option>
								<option>Information and Technology Services</option>
								<option>Public Safety</option>
								<option>Registrar</option>
								<option>Option 4</option>
							</select>
						</div>
						<div class="form-group">
							<label for="manager">Hiring Manager Username:</label>
							<input type="text" class="form-control" id="manager" name="manager">
						</div>
						<div class="form-group">
							<label for="manager_id">Hiring Manager ID Number:</label>
							<input type="text" class="form-control" id="manager_id" name="manager_id">
						</div>
						<!-- End Department Information section -->

						<!-- Begin Employee Information section -->
						<legend>Employee Information</legend>
						<label class="radio-inline"><input type="radio" name="status" value="new" required> New Employee</label>
						<label class="radio-inline"><input type="radio" name="status" value="term" required> Terminated
							Employee</label>
						<label class="radio-inline"><input type="radio" name="status" value="mod" required> Existing
							Employee</label>
						<br><br>
						<div class="form-group">
							<label for="user_name">Full Name:</label>
							<input type="text" class="form-control" id="user_name" name="user_name">
						</div>
						<div class="form-group">
							<label for="user_id">St. Thomas ID Number:</label>
							<input type="text" class="form-control" id="user_id" name="user_id">
						</div>
						<div class="form-group">
							<label for="username">Username:</label>
							<input type="text" class="form-control" id="username" name="username">
						</div>
						<!-- End Employee Information section -->

						<!-- Begin Permissions section -->
						<legend>Permissions</legend>
						<div id="placeholder">
							<p><i>Select a department to display options!</i></p>
						</div>
						<div id="its_input">
							<div class="checkbox">
								<label><input type="checkbox" value="">ITS email</label>
							</div>
							<div class="checkbox">
								<label><input type="checkbox" value="">Web Help Desk</label>
							</div>
							<div class="checkbox disabled">
								<label><input type="checkbox" value="">Ticket Assist</label>
							</div>
						</div>
						<div id="pubsafe_input">
							<div class="checkbox">
								<label><input type="checkbox" value="">Card Access</label>
							</div>
							<div class="checkbox">
								<label><input type="checkbox" value="">BossCops</label>
							</div>
							<div class="checkbox disabled">
								<label><input type="checkbox" value="">Ticket Assist</label>
							</div>
						</div>
						<!-- End Permissions section -->

						<!-- Begin Additional Permissions section -->
						<legend>Additional Permissions</legend>
						<p><i>Click "+" for multiple additional permissions.</i></p>
						<div id="items">
						</div>
						<div class="input-group" style="margin-bottom: 5px;">
						<span class="input-group-btn">
							<button type="button" class="btn btn-success add"><span
										class="glyphicon glyphicon-plus"></span></button>
						</span>
							<input class="form-control addtl_perm new_perm" type="text" name="input[]">
						</div>
						<!-- End Additional Permissions section -->

						<!-- Begin Comments section -->
						<legend>Comments</legend>
						<div class="form-group">
							<textarea class="form-control" rows="7" id="comments"></textarea>
						</div>
						<!-- Begin Comments section -->

						<!-- Submit button and end of form -->
						<button type="submit" class="btn btn-custom">Submit Request</button>
					</form>

					<!-- Footer with contact information -->
					<hr>
					<p class="footer_text"><i>Please contact the Tech Desk at techdesk@stthomas.edu or 651-962-6230 with
							any questions or concerns.</i></p>

				</div>
			</div>

		</div> <!--End div for main section-->
		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
		<br><br><br><br><br>

	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->


</body>
<script type="text/javascript">
    $(document).ready(function() {
        $(window).keydown(function(event){
            if(event.keyCode == 13) {
                event.preventDefault();
                if($( '.addtl_perm' ).is(":focus")){
                    $(".add").click();
				}
                return false;
            }
        });
    });

    $(document).ready(function ($) {
        //when the Add Filed button is clicked
        $("body").on("click", ".add", function () {
            // Change + button to X button
            $(this).parent("span").html('<button type="button" class="btn btn-danger delete"><span class="glyphicon glyphicon-remove"</span></button>');
            // Disable the textbox, then remove "new_perm" class, which
            // should only be on the input with the green + next to it
            $('.new_perm').prop('disabled', true).removeClass("new_perm");
            // prepend new input with green + button
            $("#items").prepend(
                '<div class="input-group" style="margin-bottom: 5px;">' +
					'<span class="input-group-btn">' +
						'<button type="button" class="btn btn-success add">' +
							'<span class="glyphicon glyphicon-plus"></span>' +
						'</button>' +
					'</span>' +
					'<input class="form-control addtl_perm new_perm" type="text" name="input[]">' +
				'</div>'
			);
            // focus newly created input
            $(".new_perm").focus();
        });

        $("body").on("click", ".delete", function (e) {
            $(this).parent("span").parent("div").remove();
        });


        $(".scroll").click(function (event) {
            event.preventDefault();
            $('html,body').animate({scrollTop: $(this.hash).offset().top}, 1200);
        });

    });
	//
    //Append a new row of code to the "#items" div
	/*function addInput () {
        }*/

    // Hides all of the Further Details options, and is called when the reset form button is pressed
    function hideAll(){
        $selected = $('#typeselect');
        $('#placeholder').hide();
        $('#its_input').hide();
        $('#pubsafe_input').hide();
        $('#registrar_input').hide();

    }

    // Runs when the page is fully loaded. Hides all Further Details options
    $( document ).ready(function() {
        $selected = $('#typeselect');
        hideAll(); // Begin with all options hidden
        $('#placeholder').show();

        // When the select input is changed, hide irrelevant options and show relevant ones
        $selected.change(function(){
            if($(this).val() == "" || $(this).val() == "None Applicable"){
                hideAll();
            }
            if($(this).val() == "Information and Technology Services"){
                hideAll();
                $('#its_input').show();
            }
            if($(this).val() == "Registrar"){
                hideAll();
                $('#registrar_input').show();
            }
            if($(this).val() == "Public Safety"){
                hideAll();
                $('#pubsafe_input').show();
            }
            if($(this).val() == "Network"){
                hideAll();
                $('#network_input').show();
            }
            if($(this).val() == "Webpage"){
                hideAll();
                $('#web_input').show();
            }
            if($(this).val() == "All Selected"){
                $('#asset_input').show();
                $('#hardware_input').show();
                $('#software_input').show();
                $('#printer_input').show();
                $('#web_input').show();
                $('#network_input').show();
            }
        });
    });
</script>
</html>
