<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");

	if(!empty($_GET['toEdit'])){

		require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
		$guidetoedit = $_GET['toEdit'];
		$url_ext = "";
		if(strcmp($guidetoedit,'') != 0){
			$url_ext = '?toEdit=' . $guidetoedit;
		}
		/*
			The following code perform a SQL query that grabs the log the user intends to edit.
			It is then outputed into the form so that they can see the current data in the row
			before they update it.
		*/
		$sql = "SELECT * FROM guides WHERE filename LIKE '$guidetoedit'";
		$result = mysqli_query($con, $sql);
		if(!$result){
			echo "error";
		}else{
			$row = mysqli_fetch_assoc($result);
			$editTopic = $row['topic'];
			$editGuideName = $row['guide_name'];
			$editOverview = $row['overview'];
			$body_orig = $row['body'];
            $editBody = str_replace("panel-collapse collapse", "panel-collapse collapse in", $body_orig);
		}
	}else{
		$editTopic = "";
		$editGuideName = "";
		$editOverview = "";
		$editBody = '
			<h1>Example Guide</h1>
			<h2>Overview</h2>
			<p>This is an overview of what an \'example\' is and how it is used on campus, as well as common tickets that are associated with it.</p>
			<h2>Topic 1</h2>
			<p>This is the first section.</p>
			<h2>Topic 2</p>
			<p>This is the second section. Ordered lists should be used when listing directions.</p>
			<ol>
				<li>This</li>
				<li>is</li>
				<li>a list</li>
			</ol>
		';
	}
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
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>
      //See http://archive.tinymce.com/wiki.php/Controls for toolbar options
      //See https://www.tinymce.com/docs/demo/custom-toolbar-button/ for custom button options used to make inserttoggle
		tinymce.init({
			browser_spellcheck : true,
			selector:'textarea',
            content_css: 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
			toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | inserttoggle',
			plugins: 'link image code autolink lists',
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
						var strBuilder2 = '\" data-toggle="collapse">Click to Toggle Information</a></h4> </div> <div id="collapse_';
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
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
		<!-- White space on left 1/12th of the page -->
		</div>

		<div class="col-md-10 text-left">

			<h1>Create Guide</h1>
			<p>This form will allow you to create a new guide that will be seen in the Guide Index. Please follow the directions carefully, or the guide will likely not look right when viewing it.</p>
			<p><em>* denotes required field.</em></p>
			<form id="guideForm" action="sendGuide.php" method="post" target="iFrame">
				<div class="form-group">
					<label for="title">Title: *</label>
					<input class="form-control" name="title" placeholder="Writing an Example Guide" value="<?php echo $editGuideName; ?>" required>
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
				<div class="form-group">
					<label for="body">Guide Body: *</label>
					<textarea class="form-control" name="body" rows="30" required ><?php echo $editBody; ?> </textarea>
				</div>

				<div class="form-group">
					<label for="overview">Overview: (Note: The Overview field below should NOT be the overview paragraph from your guide.)</label>
					<input class="form-control" name="overview" value="<?php echo $editOverview; ?>" required>
				</div>

				<button type="submit" form="guideForm" class="btn btn-custom">Submit</button>



			</form>
			<?php 
			if(isset($_GET['toEdit'])){
				echo '<br>
					<form id="delForm" action="deleteGuide.php" method="post" target="iFrame">
					<input type="hidden" name="toDelete" value="'.$editGuideName.'">
					<button type="button" class="btn btn-danger" onclick="submitDelete();">Delete Guide</button>
					</form>
				';
			}
			?>
			<br>
			<iframe src="#" align="left" name="iFrame" width="100%" height="100" frameBorder="0" marginwidth="0" style="display: none;"></iframe>	
			<br><br><br><br><br>
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
