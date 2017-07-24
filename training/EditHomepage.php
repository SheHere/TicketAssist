<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");

	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$pagetoedit = $_GET['toEdit'];
	$url_ext = "";
	/*
		The following code perform a SQL query that grabs the log the user intends to edit.
		It is then outputed into the form so that they can see the current data in the row
		before they update it.
	*/
	$sql = "SELECT * FROM training_pages WHERE id  = -1";
	$result = mysqli_query($con, $sql);
	if(!$result){
		echo "error";
	}else{
		$row = mysqli_fetch_assoc($result);
		$editPageName = $row['title'];
		$body_orig = $row['body'];
		$editBody = str_replace("panel-collapse collapse", "panel-collapse collapse in", $body_orig);
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
	<title> Home Editor </title>
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
            toolbar: 'undo redo | formatselect | forecolor backcolor | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | inserttoggle',
            plugins: 'link image code autolink lists textcolor',
            file_browser_callback: function(field_name, url, type, win) {
                if(type=='image') $('#img_form input').click();
            },
            setup: function(editor){
                // Allows for insertion of Bootstrap collapse
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
                        // Build string that will be inserted
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
		<?php if(isset($alert)){
			echo 'errorAlert("'.$alert.'", "TrainingHome.php");';
		}
		?>
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

		<div class="col-md-7 text-left">

			<h1>Training Home</h1>
			<form id="trainingguideForm" action="updateHome.php" method="post" target="iFrame">
				<input type="hidden" class="form-control" name="title" value="Training Home" required>
				<div class="form-group">
					<textarea class="form-control" name="body" rows="27" required ><?php echo $editBody; ?> </textarea>
				</div>
				<button type="submit" form="trainingguideForm" class="btn btn-custom">Submit Changes</button>
				<a href="TrainingHome.php" class="btn btn-danger">Cancel and Return Home</a>
			</form>
			<br>
			<iframe src="#" align="left" name="iFrame" width="100%" height="100" frameBorder="0" marginwidth="0" style="display: none;"></iframe>
			<!-- Begin image upload form -->
			<form id="img_form" action="uploadImage.php" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
				<input form="img_form" name="guideID" type="hidden" value="<?php echo $id; ?>">
				<input name="image" type="file" onchange="$('#img_form').submit();this.value='';">
			</form>
			<iframe id="form_target" name="form_target" style="height: 400px; width: 400px; display:none"></iframe>
		</div> <!--End div for main section-->
		<div class="col-md-3 text-left">
			<h1>All Available Pages</h1>
			<?php
			require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
			$sql = "SELECT * FROM training_pages WHERE id > 0 ORDER BY title;";
			$result = mysqli_query($con, $sql);
			$printConcat = "<ul>";
			if (mysqli_num_rows($result) > 0) {
				// output data of each row
				while($row = mysqli_fetch_assoc($result)) {
					$title = html_entity_decode($row['title']);
					$path = html_entity_decode($row['path']);
					$printConcat .=  '
					<li>
						<a href="Page.php?title='.$path.'">'.$title.'</a>
					</li>
					';
				}
				echo $printConcat . '</ul>';
			} else {
				echo "0 results";
			}
			?>
		</div>
		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
include ($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
?>
</body>
</html>
