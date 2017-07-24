<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
/*
	The following code perform a SQL query that grabs the log the user intends to edit.
	It is then outputed into the form so that they can see the current data in the row
	before they update it.
*/
if( isset($_GET['id']) || isset($_GET['toEdit'])){
	// Accepts both id and path to find the guide, but prefers id if both are sent
	if(isset($_GET['id'])){
		$idtoedit = preg_replace("/0-9]/", '', $_GET['id']);
		$sql = "SELECT * FROM `training_pages` WHERE `id` = $idtoedit;";
	}
	else if( isset($_GET['toEdit']) ){
		$guidetoedit = preg_replace("/[^a-zA-Z0-9]/", '', $_GET['toEdit']);
		$sql = "SELECT * FROM `training_pages` WHERE `path` LIKE '$guidetoedit';";
	}
	// Send query and if a single row is not found, throw error.
	$result = mysqli_query($con, $sql);
	if(!$result || mysqli_num_rows($result) != 1){
		echo "Database Error: ";
		$alert = "Invalid guide name.";
	}else {
		$row = mysqli_fetch_assoc($result);
		$id = $row['id'];
		$editGuideName = $row['title'];
		$body_orig = $row['body'];
		// If body is empty (ie. a new guide) then set to default
		if (strcmp($body_orig, "") == 0) {
			$editBody = '
				<h1>Example Guide</h1>
				<h2>Overview</h2>
				<p>This is an introductory paragraph!</p>
				<h2>Topic 1</h2>
				<p>This is the first section.</p>
				<h2>Topic 2</p>
				<p>Ordered lists should be used when listing directions.</p>
				<ol>
					<li>This</li>
					<li>is</li>
					<li>a list</li>
				</ol>
			';
		} else {
			// Allows collapses to be editable
			$editBody = str_replace("panel-collapse collapse", "panel-collapse collapse in", $body_orig);
		}
	}
}else{
	$alert = "Invalid Guide. Please ";
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
	<title> Training Guide Editor </title>
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

		<div class="col-md-10 text-left">
			<h1>Guide Editor</h1>
			<p><em>* denotes required field.</em></p>
			<form id="guideForm" action="sendTrGuide.php" method="post" target="iFrame">
				<div class="form-group">
					<label for="title">Title: *</label>
					<input class="form-control" form="guideForm" name="title" placeholder="How to Tech Desk" value="<?php echo $editGuideName; ?>" required>
				</div>
				<div class="form-group">
					<label for="body">Guide Body: *</label>
					<p style="color: red;"><i>Hey! We now support image uploading! Click Insert, then Image, then the button with the folder symbol!</i></p>
					<!-- Note: bodytext is not passed directly. See JavaScript below -->
					<textarea id="bodytext" form="guideForm" class="form-control" name="bodytext" rows="30" required ><?php echo $editBody; ?> </textarea>
					<input type="hidden" name="body_helper" id="body_helper">
				</div>
				<input type="hidden" form="guideForm" name="guide_id" value="<?php echo $id ?>">
				<button type="submit" form="guideForm" class="btn btn-custom">Submit Guide</button>
				<br>
			</form>
			<!-- Begin image upload form -->
			<form id="img_form" action="uploadImage.php" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden">
				<input form="img_form" name="guideID" type="hidden" value="<?php echo $id; ?>">
				<input name="image" type="file" onchange="$('#img_form').submit();this.value='';">
			</form>
			<iframe id="form_target" name="form_target" style="height: 400px; width: 400px; display:none"></iframe>

			<a href="Page.php?id=<?php echo $id; ?>" style="margin-top: 7px;" class="btn btn-warning">Cancel and Return</a>

			<!-- Begin Delete form-->
			<form id="delForm" action="deleteTrGuide.php" method="post" target="iFrame">
				<input type="hidden" name="toDelete" value="<?php echo $id; ?>">
				<button type="button" class="btn btn-danger" style="margin-top: 7px;" onclick="submitDelete();">Delete Guide</button>
			</form>

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
    //Sends guideForm to sendGuide via AJAX request
    $("#guideForm").submit(function(e){
        // AJAX request does not send value of body by itself because of the editor.
        // The following line sets the value of the editor to a hidden form field.
        $('#body_helper').val(tinyMCE.get('bodytext').getContent());
        var frm = $("#guideForm");
        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function(data){
                if( data == 'error'){
                    swal({
                        title: "Oops!",
                        text: "An error occured.",
                        type: "error",
                        html: true
                    });
                }else{
                    window.location.href = data;
                }
            }
        })
        e.preventDefault();
    });
    // Delete guide, require user confirmation
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
