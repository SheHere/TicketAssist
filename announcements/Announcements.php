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
	<title> New Announcement </title>
	<?php 
		include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
		fullHeader();
	?>
	
	<!-- TinyMCE is a 3rd party WYSIWYG. The following scripts initialize it for this page. -->
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>
        //See http://archive.tinymce.com/wiki.php/Controls for toolbar options
        //See https://www.tinymce.com/docs/demo/custom-toolbar-button/ for custom button options used to make inserttoggle
        tinymce.init({
            browser_spellcheck : true,
            selector:'textarea',
            content_css: 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
            toolbar: 'undo redo | formatselect | forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | inserttoggle',
            plugins: 'link image code autolink lists textcolor',
            setup: function(editor){
                editor.addButton('inserttoggle', {
                    text: 'Insert Toggle',
                    icon: false,
                    onclick: function() {
                        //To ensure that each toggle has a unique ID, it is given a random 4 character string
                        var length = 5,
                            charset = "abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ012345678901234567890123456789",
                            retVal = '';
                        for (var i = 0, n = charset.length; i < length; ++i) {
                            retVal += charset.charAt(Math.floor(Math.random() * n));
                        }
                        var strBuilder1 = '<div class=\"panel-group\"> <div class=\"panel panel-default"> <div class="panel-heading"> <h4 class="panel-title"><a href="#collapse_';
                        //Add retVal
                        var strBuilder2 = '\" data-toggle="collapse">&nbsp;Click to Toggle Information&nbsp;</a></h4> </div> <div id="collapse_';
                        //Add retVal
                        var strBuilder3 = '\" class="panel-collapse collapse in"> <div class="panel-body"> [Replace this with your content] </div></div></div></div><p></p>';
                        var toPrint = strBuilder1.concat(retVal, strBuilder2, retVal, strBuilder3);
                        editor.insertContent(toPrint);
                    }
                });
            }
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
					<li <?php if(strcmp('remove',$_GET['tab']) != 0){echo 'class="active"';} ?>><a data-toggle="tab" href="#new">New Anouncement</a></li>
					<li <?php if(strcmp('remove',$_GET['tab']) == 0){echo 'class="active"';} ?>><a data-toggle="tab" href="#remove">Remove Announcement</a></li>
				</ul>

				<div class="tab-content">
					<div id="new" class="tab-pane fade <?php if(strcmp('remove',$_GET['tab']) != 0){echo 'in active';} ?>">
						<h1>Create New Entry</h1>
						<p>This form will allow you to submmit a new announcement that will be displayed on the home page.</p>
						<p>This page should only be accessible by admin users.<p>
						<form id="announcementForm" action="sendAnnounce.php" method="post" target="sendiFrame">
							<div class="form-group">
								<label for="title">Title:</label>
								<input class="form-control" name="title" placeholder="Announcement Title" required>
							</div>
							<div class="form-group">
								<label for="author">Author:</label>
								<input class="form-control" name="author" placeholder="John Example" required>
							</div>
							<div class="form-group">
								<label for="message">Message:</label>
								<textarea class="form-control" name="message" rows="13" placeholder="Write your announcement here."></textarea>
							</div>
							<button type="submit" class="btn btn-custom">Submit</button>
						</form>
						<br>
						<iframe style="display: none;" align="left" name="sendiFrame" width="100%" height="500" frameBorder="0" marginwidth="0"></iframe>
					</div>
					<div id="remove" class="tab-pane fade<?php if(strcmp('remove',$_GET['tab']) == 0){echo 'in active';} ?>">
						<h1>Remove Entry</h1>
						<p>This form will allow you to remove an announcement so that it no longer shows on the front page.</p>
						<p>This page should only be accessible by admin users.<p>
						<form id="announcementForm" action="deleteAnnounce.php" method="post" target="removeiFrame">
							<table class="sortable table table-striped">
							<thead>
								<tr>
									<th>Select</th>
									<th>ID</th>
									<th>Date Created</th>
									<th>Author</th>
									<th>Title</th>
								</tr>
							</thead>
							<tbody>
							<?php
								require($_SERVER['DOCUMENT_ROOT'] . "/loginutils/connectdb.php");

								$output = "";

								$sql = "SELECT * FROM `announcements`";
								$result = mysqli_query($con, $sql);
								if (mysqli_num_rows($result) > 0) {
									// output data of each row
									while($row = mysqli_fetch_assoc($result)) {
										if($row['visibility']==1){
										$count = $row['count'];
										$date = $row['date'];
										$author = html_entity_decode($row['author']);
										$title = html_entity_decode($row['title']);

										$output =
										'<tr>
											<th>
												<div class="checkbox">
													<label class="checkbox-inline">
														<input type="checkbox" name="toRemove[]" value="' . $count . '">
													</label>
												</div>
											</th>
											<th>' . $count . '</th>
											<th>' . $date . '</th>
											<th>' . $author . '</th>
											<th>' . $title . '</th>
										</tr>'
										. $output;
										}
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
