<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html>
<head>
	<title> Edit Responses </title>
	<?php 
		include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
		fullHeader();
	?>
	
	<!-- TinyMCE is a 3rd party WYSIWYG. The following scripts initialize it for this page. -->
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>
		tinymce.init({
			// Allows the browser to spellcheck within the text area
			browser_spellcheck : true,
			// Selects all textareas
			selector:'textarea',
			// Initilizes plugins to inlcude hyperlinks, online images, view the text area in HTML (code), and automatically turn URLs into hyperlinks
			plugins: 'link image code autolink',
			//Change new lines to line breaks to avoid sloppy new lines
			forced_root_block : false 
		});
	</script>	
</head>
<body>

<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
		<!-- White space on left 1/12th of the page -->
		</div>

		<div class="col-md-10 text-left">
			<br>
			<div id="announcement_tabs">
				<ul class="nav nav-tabs">
					<li <?php if(strcmp('remove',$_GET['tab']) != 0){echo 'class="active"';} ?>><a data-toggle="tab" href="#new">New Response</a></li>
					<li <?php if(strcmp('remove',$_GET['tab']) == 0){echo 'class="active"';} ?>><a data-toggle="tab" href="#remove">Delete Response</a></li>
				</ul>

				<div class="tab-content">
					<div id="new" class="tab-pane fade <?php if(strcmp('remove',$_GET['tab']) != 0){echo 'in active';} ?>">
						<h1>Create New Response</h1>
						<p>This form will allow you to create a new generic reponse that can be accessed on the home page.</p>
						<form id="newForm" action="sendResponse.php" method="post" target="sendiFrame">
							<div class="form-group">
								<label for="title">Title:</label>
								<input class="form-control" name="title" placeholder="Response Title" required>
							</div>
							<div class="form-group">
								<label for="message">Body:</label>
								<textarea class="form-control" name="message" rows="5" ></textarea>
							</div>
							<button type="submit" class="btn btn-custom">Submit</button>
						</form>
						<br>
						<iframe style="display: block;" align="left" name="sendiFrame" width="100%" height="500" frameBorder="0" marginwidth="0"></iframe>
					</div>
					<div id="remove" class="tab-pane fade<?php if(strcmp('remove',$_GET['tab']) == 0){echo 'in active';} ?>">
						<h1>Remove Response</h1>
						<p>This form will allow you to remove a response so that it no longer shows on the front page.</p>
						<form id="removeForm" action="deleteResponse.php" method="post" target="removeiFrame">
							<table class="sortable table table-striped">
							<thead>
								<tr>
									<th>Select</th>
									<th>Title</th>
								</tr>
							</thead>
							<tbody>
							<?php
								require($_SERVER['DOCUMENT_ROOT'] . "/loginutils/connectdb.php");

								$output = "";
								$cur_user = $_SESSION['username'];
								$sql = "SELECT * FROM `genericResponse` WHERE username LIKE '$cur_user';";
								$result = mysqli_query($con, $sql);
								if (mysqli_num_rows($result) > 0) {
									// output data of each row
									while($row = mysqli_fetch_assoc($result)) {
										$id = $row['id'];
										$title = html_entity_decode($row['title']);
										$output =
										'<tr>
											<th>
												<div class="checkbox">
													<label class="checkbox-inline">
														<input type="checkbox" name="toRemove[]" value="' . $id . '">
													</label>
												</div>
											</th>
											<th>' . $title . '</th>
										</tr>'
										. $output;
									}
									echo $output;
								}
							?>
							</tbody>
							</table>

							<button type="submit" class="btn btn-danger" value="submit">Remove Selected</button>
						</form>
						<br>
						<iframe style="display: none;" align="left" name="removeiFrame" width="1px" height="1px" frameBorder="0" marginwidth="0"></iframe>
					</div>
				</div>
			</div>



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
