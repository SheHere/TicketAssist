<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");

$toEdit = $_GET['id'];
require($_SERVER['DOCUMENT_ROOT'] . "/loginutils/connectdb.php");
$toEditSQL = "SELECT * FROM genericResponse WHERE id = $toEdit;";
$toEditResult = mysqli_query($con, $toEditSQL);
if (mysqli_num_rows($toEditResult) > 0) {
    $entry = mysqli_fetch_assoc($toEditResult);
    $toEditID = $entry['id'];
    $toEditTitle = html_entity_decode($entry['title']);
    $toEditMsg_body = html_entity_decode($entry['msg_body']);
}

$groupsSQL = "SELECT * from genericResponseGroups ORDER BY ordering ASC";
$groupResult = mysqli_query($con, $groupsSQL);
$options = "<option value=\"\">----</option>";
if (mysqli_num_rows($groupResult) > 0) {
    // If rows exist, create toggles for them. Then populate those toggles with entries from contactFTE and user (for students).
    while ($g_row = mysqli_fetch_assoc($groupResult)) {
        //Looping through all contact_groups
        $group_name = $g_row['group_name'];
        $group_id = $g_row['id'];
        $options .= '
        <option value="'.$group_id.'">'.$group_name.'</option>';
    }
}

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
    include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
    datatablesHeader();
    ?>

    <!-- TinyMCE is a 3rd party WYSIWYG. The following scripts initialize it for this page. -->
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        tinymce.init({
            // Allows the browser to spellcheck within the text area
            browser_spellcheck: true,
            // Selects all textareas
            selector: 'textarea',
            // Initializes plugins to include hyperlinks, online images, view the text area in HTML (code), and automatically turn URLs into hyperlinks
            plugins: 'link image code autolink',
            //Change new lines to line breaks to avoid sloppy new lines
            forced_root_block: false
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
			<h1>Create New Response</h1>
			<p>This form will allow you to create a new generic reponse that can be accessed on the home
				page.</p>
			<form id="newForm" action="sendResponse.php" method="post" target="sendiFrame">
				<div class="form-group">
					<label for="title">Title:</label>
					<input class="form-control" name="title" required
						   placeholder="Response Title" <?php if (isset($toEditTitle)) {
						echo 'value="' . $toEditTitle . '"';
					} ?> required>
				</div>
				<div class="form-group">
					<label for="sel1">Grouping:</label>
					<select class="form-control" name="group" required>
						<?php echo $options; ?>
					</select>
				</div>
				<div class="form-group">
					<label for="message">Body:</label>
					<textarea class="form-control" name="message"
							  rows="5"><?php if (isset($toEditMsg_body)) {
							echo $toEditMsg_body;
						} ?></textarea>
				</div>
				<input type="hidden" value="<?php if (isset($toEditID)) {
					echo $toEditID;
				} else {
					echo '-1';
				} ?>" name="update">

				<button type="submit" class="btn btn-custom">Submit</button>
			</form>
			<br>
			<iframe style="display: block;" align="left" name="sendiFrame" width="100%" height="500"
					frameBorder="0" marginwidth="0"></iframe>
        </div> <!--End div for center columns-->

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
