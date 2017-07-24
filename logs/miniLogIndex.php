<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); ?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Log Index</title>
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	datatablesHeader();
	?>
	<style>
		.btn-block {
			width: 90%;
		}
		.tablerow {
			margin-bottom: 5px;
		}
		#x td {
			display: inline-block;
		}
	</style>
	<!-- The following allows for the buttons that copy to clipboard -->
	<script src="//tdta.stthomas.edu/third-party-packages/clipboard.js-master/dist/clipboard.min.js"></script>
    <script>
        $( document ).ready(function(){
            new Clipboard('.copybtn', {
                text: function(trigger) {
                    return trigger.getAttribute('aria-label');
                }
            });
        });
    </script>
	<base target="_parent">

</head>
<body>

<div class="container-fluid text-center">
	<div class="row content">

		<!--
		---- Begin main section, which will call the HTML from the input file
		--->
		<div class="col-lg-12 text-left">

			<h1>Unresolved Logs <input type="button" class="btn btn-default" value="Refresh Table"
									   onClick="window.location.reload(true)"></h1>
			<p><a href="https://tdta.stthomas.edu/logs/logIndex.php">See all logs here.</a>
			<p>

				<!--
				---- The classe "sortable" calls .js file that allows the table to be sorted, the class "table" is a Bootstrap
				---- class that formats it nicely, and "table-striped" is a Bootstrap class that makes every-other entry
				---- a gray color so each entry stands out better.
				-->

			<form id="minilogForm" action="updateLog.php" method="post" target="iFrame">
				<table id="x" class="display table table-striped">
					<colgroup>
						<col span="1" style="width:10%;">
						<col span="1" style="width:60%;">
						<col span="1" style="width:30%%;">
					</colgroup>
					<thead>
					<tr>
						<th>Date Created</th>
						<th>Log</th>
						<th>Options</th>
					</tr>
					</thead>
					<tbody>
					<?php
					/*
						The following PHP send a request to the database looking for each log entry that belongs to the current user.
						It displays them in descending order by ID, which is also by most recent.
						It will only show open logs, those with current_status = 1.
					*/
					require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
					$username = $_SESSION['username'];
					$output = "";
					$sql = "SELECT * FROM logs WHERE username LIKE '$username'";
					$result = mysqli_query($con, $sql);
					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while ($row = mysqli_fetch_assoc($result)) {
							$id = $row['id'];
							$date = $row['date'];
							$log_text = $row['log_text'];
							$current_status = $row['current_status'];
							$selectedOpen = '';
							$selectedFlagged = '';
							if ($current_status == 1) {
								/*
								Create table row, populating with information from the logs relation.
								The <span> below forces the log text to be normal, rather than bolded.
								*/
								$output = '
									<tr>
										<th>' . $date . '</th>
										<th id="copylog' . $id . '"><span style="font-weight: normal;">' . $log_text . '</span></th>
										<th>
											<div class="row tablerow">
												<div class="form group">
													<select class="form-control" name="select' . $id . '" onchange="submitFunction();" style="width: 90%; text-align: center">
														<option value="1" selected>In Progress</option>
														<option value="2">Ticket Created</option>
													</select>
												</div>
											</div>
											<div class="row tablerow">
												<button class="btn btn-block btn-default copybtn" id="btn'.$id.'" data-clipboard-target="#copylog'.$id.'"><span class="glyphicon glyphicon-copy"></span> Copy to Clipboard</button>
											</div>
										</th>
									</tr>' . $output;
							}
						}
						echo $output;
					}
					?>
					</tbody>
				</table>
			</form>
			<iframe style="padding-top: 3px;" name="iFrame" width="100%" height="1" style="display: none;"
					frameBorder="0"></iframe>
		</div> <!--End div for main section-->

	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<script>
    function submitFunction() {
        document.getElementById("minilogForm").submit();
    }
    /*function divClicked() {
        var divHtml = $(this).html();
        var editableText = $("<textarea class='form-control' rows='10'/>");
        editableText.val(divHtml);
        $(this).replaceWith(editableText);
        editableText.focus();
        // setup the blur event for this new textarea
        editableText.blur(editableTextBlurred);
    }

    function editableTextBlurred() {
        var html = $(this).val();
        var viewableText = $("<div>");
        viewableText.html(html);
        $(this).replaceWith(viewableText);
        // setup the click event for this new div
        viewableText.click(divClicked);
    }

    $(document).ready(function() {
        $("span").click(divClicked);
    }); */

</script>
</body>
</html>







