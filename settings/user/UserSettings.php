<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); ?>
<!--
<--- Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->


<!DOCTYPE html>
<html lang="en">
<head>
  <title> User Settings </title>

  	<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
  <!-- Jasny Bootstrap is an extension for Bootstrap that allows the upload formatting to work -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script src="../../third-party-packages/jscolor-2.0.4/jscolor.js"></script>
  <?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/alerts.php'; ?>
  <script>
		tinymce.init({
			browser_spellcheck : true,
			selector:'textarea',
			plugins: 'link image code autolink',
		});
  </script>

  <style>
    iframe {
      display: none;
    }
  </style>
</head>
<body>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-6 text-left">
			<div class="col-md-12">
				<?php
					require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

					$username = $_SESSION['username'];

					/*
						The following code perform a SQL query that grabs the current user's info.
						It is then outputed into the form so that they can see their current info
						befor they update it.
					*/
					$sql = "SELECT *
							FROM users INNER JOIN megalink USING(username)
							WHERE username LIKE '$username';";
					$result = mysqli_query($con, $sql);
					if (!$result) {
						echo '<div class="alert alert-danger" role="alert"><strong>Oops!</strong> Something went wrong.<br>SQL Error: ';
						echo mysqli_error($con);
						echo '</div>';
					} else {
						$ret = mysqli_fetch_assoc($result);
						//Get info from users
						$firstname = $ret['fname'];
						$lastname = $ret['lname'];
						$bio = $ret['bio'];
						$imgpath = $ret['img_path'];
						//Get info from megalink
						$link1url = $row['link1'];
						$link2url = $row['link2'];
						$link3url = $row['link3'];
						$link4url = $row['link4'];
						$link5url = $row['link5'];
					}

          $sql = "SELECT `color`
                  FROM `users`
                  WHERE `username` LIKE '$username';";
          $result = mysqli_query($con, $sql);
          if (!$result) {
            echo '<div class="alert alert-danger" role="alert"><strong>Oops!</strong> Something went wrong.<br>SQL Error: ';
						echo mysqli_error($con);
						echo '</div>';
          } else {
            $ret = mysqli_fetch_assoc($result);
            $color = $ret['color'];
          }
					?>
					<h1>Personal Information</h1>
						<p>Make changes to your personal information with the form below. This information will be shown on the Student Roster, found <a href="http://140.209.47.120/StudentRoster/studentbios.php">here</a>. To change your password, please go to the password reset page found <a href="http://140.209.47.120/settings/user/PasswordUpdate.php">here</a>.</p>
					<form id="newUserForm" action="updateUsers.php" method="post" target="iFrame1">
						<div class="form-group">
							<label for="author">First Name:</label>
							<input class="form-control" name="fname"value="<?php echo $firstname; ?> ">
						</div>
						<div class="form-group">
							<label for="title">Last Name:</label>
							<input class="form-control" name="lname"value="<?php echo $lastname; ?>">
						</div>
						<div class="form-group">
							<label for="message">Bio:</label>
							<textarea class="form-control" name="bio" rows="5" maxlength="500" onkeyup="this.value = this.value.replace(/(?:\r\n|\r|\n)/g, '')"><?php echo $bio; ?></textarea>
						</div>
						<button type="submit" class="btn btn-block btn-custom" onclick="myFunction('iFrame1');">Update Personal Information</button>
					</form>
					<br>
					<div class="iFrame1" id="iFrame1" style="display: none;">
					<iframe name="iFrame1" width="100%" height="auto" frameBorder="0" marginwidth="0px"></iframe>
				</div>
			</div>
			<div class="col-md-12">
				<div class="col-md-5">
					<h1 style="margin-top:0px;">Upload Bio Image</h1>
					<form name="uploadform" enctype="multipart/form-data" action="uploader.php" method="POST" target="iFrame3">
						<input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"></div>
							<div>
								<span class="btn btn-custom btn-file">
									<span class="fileinput-new">Select bio image</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" accept=".jpeg, .jpg" name="uploadedfile" onchange="uploadform.submit();myFunction('iFrame3');">
								</span>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-7">
					<div class="alert alert-warning">
						<strong>Only files with a .jpeg or .jpg extension are accepted!</strong>
            <strong>Max file size: 1 MB</strong>
					</div>
					<div class="iFrame3" id="iFrame3" style="display: none;">
						<iframe name="iFrame3" width="100%" height="auto" frameBorder="0" marginwidth="0px"></iframe>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 text-left">
			<h1>Mega Links</h1>
			<p>The Mega Link button found in the nav bar above can open up to five links. By default, these are set to Web Help Desk, the ITS homapage, and the password page on random.org. To add a link, paste the URL into one of the form inputs below. To remove a link, delete the entry and leave it blank.</p>
			<form id="megalinkForm" action="updateMegaLink.php" method="post" target="iFrame2">
				<div class="form-group">
					<label for="link1url">Link 1:</label>
					<input class="form-control" name="link1url" value="<?php echo $link1url; ?>">
				</div>
				<div class="form-group">
					<label for="link2url">Link 2:</label>
					<input class="form-control" name="link2url" value="<?php echo $link2url; ?>">
				</div>
				<div class="form-group">
					<label for="link3url">Link 3:</label>
					<input class="form-control" name="link3url" value="<?php echo $link3url; ?>">
				</div>
				<div class="form-group">
					<label for="link4url">Link 4:</label>
					<input class="form-control" name="link4url" value="<?php echo $link4url; ?>">
				</div>
				<div class="form-group">
					<label for="link5url">Link 5:</label>
					<input class="form-control" name="link5url" value="<?php echo $link5url; ?>">
				</div>
				<button type="submit" class="btn btn-block btn-custom" onclick="myFunction('iFrame2');">Update Mega Links</button>
			</form>
			<br>
			<div class="iFrame2" id="iFrame2">
				<iframe name="iFrame2" width="100%" height="auto" frameBorder="0" marginwidth="0px"></iframe>
			</div>
		</div>
    <div class="col-md-6 text-left">
      <h1>Favorite Color</h1>
      <p>Select your favorite color. This will be used in assigning your calendar color.</p>
      <form id="colorForm" action="updateColor.php" method="post" target="iFrame3">
        <input name="color" type="hidden" id="color_value" value="<?php echo $color; ?>" autocomplete="off" onchange="this.form.submit()">
        <button class="btn btn-custom jscolor {valueElement:'color_value'}" style="border: solid 1px">Select</button>
      </form>
      <iframe name="iFrame3" style="display: none;"></iframe>
    </div>
	</div><!--End of row content div -->
</div><!--End div for Bootstrap container rules-->

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
?>

  <script>
		function myFunction(sentID) {
		document.getElementById(sentID).style.display = 'block';
	}
  </script>

</body>
</html>
