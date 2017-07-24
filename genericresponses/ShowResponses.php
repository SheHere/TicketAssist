<?php

require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/auth.php');
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

//to_print is going to be printed at the end.
if($_SESSION['admin_status'] > 1){$superusertext = '';}else{$superusertext='';}
$to_print = '
    <div class="panel-group" id="accordion1">';

//Gather user's full name
$cur_user = $_SESSION['username'];
$name_sql = "SELECT fname, lname FROM users WHERE username LIKE '$cur_user';";
$name_result = mysqli_query($con, $name_sql);
$name_row = mysqli_fetch_assoc($name_result);
$firstname = $name_row['fname'];

//Begin creation of response groups
$groupsSQL = "SELECT *
FROM genericResponseGroups
ORDER BY ordering, group_name ASC
";
$groupResult = mysqli_query($con, $groupsSQL);
if (mysqli_num_rows($groupResult) > 0) {
	// If rows exist, create toggles for them. Then populate those toggles with responses from genericResponse
	while ($g_row = mysqli_fetch_assoc($groupResult)) {
		//Looping through all contact_groups
		$group_name = $g_row['group_name'];
		$group_id = $g_row['id'];
		$group_order = $g_row['ordering'];
		//Concatenate to to_print
		$to_print .= '
		<!-- Begin accordion panel for Group: ' . $group_name . ' -->
		<div class="panel panel-default" >
			<div class="panel-heading" >
				<h2 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordion1" href="#collapseID' . $group_id . '">' . $group_name . '</a>
				</h2>
			</div>
			<div id="collapseID' . $group_id . '" class="panel-collapse collapse">
				<div class="panel-body">
				<!-- Begin responses -->
				
			';

		//Fill in responses associated with above group
		$sql = "SELECT * FROM genericResponse WHERE grouping = $group_id ORDER BY title;";
		$result = mysqli_query($con, $sql);
		if (mysqli_num_rows($result) > 0) {
			$to_print .= '<div class="panel-group" id="accordion" style="margin-top: 10px;">';
			while ($row = mysqli_fetch_assoc($result)) {
				$id = $row['id'];
				$title = html_entity_decode($row['title']);
				$msg_body_gen = html_entity_decode($row['msg_body']);
				//Add user's name to response
				$patterns = array();
				$patterns[0] = '/<p>/';
				$replacements = array();
				$replacements[0] = '<p >';
				$msg_body = preg_replace($patterns, $replacements, $msg_body_gen, 1);
				$msg_body = str_replace('[YOUR NAME]', $firstname, $msg_body);

				//If user is Superuser or Admin, show edit button. Do not show otherwise.
				if ($_SESSION['admin_status'] > 1) {
					$title .= '<a style="float: right;" href="https://tdta.stthomas.edu/genericresponses/EditResponses.php?id=' . $id . '"><span class="glyphicon glyphicon-pencil"></span></a>';
				}
				$to_print = $to_print . '
                <!-- Begin panel for response: '.$row['title'].' -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion2" href="#' . $id . '">
                            ' . $title . '</a>
                        </h4>
                    </div>
                    <div id="' . $id . '" class="panel-collapse collapse">
                        <div class="panel-body">
                            <button class="btn btn-custom copybtn" id="btn'.$id.'" data-clipboard-target="#tocopy'.$id.'"><span class="glyphicon glyphicon-copy"></span> Copy to Clipboard</button>
                            <hr>
                            <div id="tocopy'.$id.'">' . $msg_body . '</div>
                        </div>
                    </div>
                </div>
                <!-- End panel for response: '.$row['title'].'-->
                ';
			}
			$to_print .= '
					</div>
				</div>
			</div>
		</div>
		<!-- End accordion panel for Group: ' . $group_name . ' -->
				';
		} else { //If no responses associated with group
			$to_print .= '<br><div class="well" style="text-align: center;"> <p>Oops! There are no generic responses available. Superusers can create and delete generic responses <a href="https://tdta.stthomas.edu/genericresponses/EditResponses.php" target="_parent">here</a>.</p>
				</div>
			</div>
		</div>
	</div>
	<!-- End accordion panel for Group: ' . $group_name . ' -->
            ';
		}
	}
	$to_print .= '</div>';
}else{
	echo "ERROR: no response groups found!";
}



?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	reducedHeader();
	?>
	<style>
		body {
			padding-right: 5px;
		}
		body > .container {
			padding: 0px 15px 15px 15px;
		}
		h2 {
			margin: 0px;
			padding: 0px;
		}
	</style>
	<!-- The following allows for the buttons that copy to clipboard -->
	<script src="//tdta.stthomas.edu/third-party-packages/clipboard.js-master/dist/clipboard.min.js"></script>
	<script>
        $(document).ready(function(){
            new Clipboard('.btn', {
                text: function(trigger) {
                    return trigger.getAttribute('aria-label');
                }
            });
        });
	</script>
	<base target="_parent">
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-xs-6" style="padding-left: 0;">
			<h1>Generic Responses</h1>
		</div>
		<div class="col-xs-6 text-right">
			<h1>
				<button id="infobutton" class="btn btn-link" type="button" onclick="parent.infoAlert('The following are email templates that should be copied directly into tech notes when appropriate to be sent to clients. Please use these instead of writing your own messages so that we can have greater consistancy in our communication!');">
					<i style="color:black;" class="fa fa-question-circle fa-2x" aria-hidden="true"></i>
				</button>
			</h1>
		</div>
	</div>
	<?php if($_SESSION['admin_status'] > 1){
		echo '<div class="row" style="margin-bottom: 15px;">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
		<div class="btn-group" role="group">
			<a href="https://tdta.stthomas.edu/genericresponses/EditResponses.php" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> - New Response</a> 
		</div>
		<div class="btn-group" role="group">
			<a href="https://tdta.stthomas.edu/genericresponses/EditResponses.php?tab=remove" class="btn btn-default"><i style="color:black;" class="fa fa-bomb fa-1x" aria-hidden="true"></i> - Delete Responses</a>
		</div>
		<div class="btn-group" role="group">
			<a target="_self" href="https://tdta.stthomas.edu/genericresponses/EditResponseGroups.php" class="btn btn-default"><i style="color:black;" class="fa fa-arrows-v fa-1x" aria-hidden="true"></i> - Edit Groups</a>
		</div>
	</div>
</div>';} ?>
	<div class="row">
		<!-- Begin to_print -->
		<?php echo $to_print; ?>
		<!-- End to_print -->
	</div>
</div>
</body>
</html>