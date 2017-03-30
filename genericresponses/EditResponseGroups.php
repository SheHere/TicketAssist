<?php

require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/SuperuserAuth.php');
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

//to_print is going to be printed at the end.

$to_print = '
        <div class="row grouprow" style="margin-bottom: 15px;">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <a target="_self" href="https://140.209.47.120/genericresponses/ShowResponses.php" class="btn btn-default"><span style="color: black;" class="glyphicon glyphicon-remove"></span> - Cancel</a> 
                </div>
                <div class="btn-group" role="group">
                    <button class="btn btn-default" type="submit" form="groupForm"><span style="color: black;" class="glyphicon glyphicon-ok"></span> - Submit Changes</button>
                </div>
            </div>
        </div>
        ';

$to_print .= '<!-- begin to_print -->
		<div class="panel-group" id="accordion">';

$groupsSQL = "SELECT *
FROM genericResponseGroups
ORDER BY ordering, group_name ASC;";
$groups_result = mysqli_query($con, $groupsSQL);

if (mysqli_num_rows($groups_result) > 0) {
	// If rows exist, create toggles for them. These toggles will be missing bodies, and cannot be actually toggled.
	while ($g_row = mysqli_fetch_assoc($groups_result)) {
		//Looping through all contact_groups
		$group_name = $g_row['group_name'];
		$group_id = $g_row['id'];
		$group_order = $g_row['ordering'];

		//Disable the ability to edit/remove the General group
		$inputQualifier = " required ";
		$btnQualifier = '';
		if ($group_id < 2) {
			$btnQualifier = " disabled ";
			$inputQualifier = " disabled ";
		}
		$to_print .= '
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
						    <label class="sr-only" for="inlineFormInputGroup'.$group_id.'">New Group</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon removeBtn"><a ' . $btnQualifier . 'class="btn btn-link sidebtn" onclick="parent.confirmDelete(\'https://140.209.47.120/assistant.php\', \'https://140.209.47.120/genericresponses/deleteRespGroup.php\', ' . $group_id . ');"><span class="glyphicon glyphicon-remove"></span></a></div>
                                <input class="form-control" type="text" name="group' . $group_id . '" value="' . $group_name . '" ' . $inputQualifier . '>
                            </div>
						</h4>
					</div>
				</div>
					';
	}
	$to_print .= '';
} else {
	echo "ERROR: no response groups found!";
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	reducedHeader();
	?>
	<link rel="stylesheet" type="text/css" href="https://140.209.47.120/sweetalert-master/dist/sweetalert.css">
	<script src="https://140.209.47.120/sweetalert-master/dist/sweetalert.min.js"></script>
	<script src="https://140.209.47.120/js/alerts.js"></script>
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
		th {
			font-weight: normal;
			word-wrap: break-word;
		}

		thead > tr > th {
			font-weight: bold;
			word-wrap: break-word;
		}
		.grouprow {
			margin-top: 10px;
			margin-right: 0px;
			margin-left: 0px;
		}

		.sidebtn {
			border: 0px solid transparent;
			padding: 0px 0px 0px 0px;
		}

		.newBtn {
			background-color: #449D44;
		}

		.removeBtn {
			background-color: #C9302C;
		}

		.glyphicon {
			color: white;
		}
	</style>
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
					<i style="color:black;" class="fa fa-question-circle fa-2x aria-hidden="true"></i>
				</button>
			</h1>
		</div>
	</div>
	<form id="groupForm" method="post" action="modifyRespGroup.php" target="iFrame">
		<?php echo $to_print; ?>
	</form>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<form id="newForm" class="form-inline" method="post" action="newRespGroup.php" target="iFrame">
					<label class="sr-only" for="inlineFormInputGroup">New Group</label>
					<div class="input-group mb-2 mr-sm-2 mb-sm-0">
						<div class="input-group-addon newBtn">
							<button class="btn btn-link sidebtn" type="submit"><span
									class="glyphicon glyphicon-plus"></span></button>
						</div>
						<input type="text" class="form-control" id="inlineFormInputGroup" name="newGroup"
							   placeholder="New Group" required>
					</div>
				</form>
			</h4>
		</div>
	</div>
	<iframe name="iFrame" width="100%" height="257px" frameBorder="1" marginwidth="0px" scrolling="no"
			style="display:none;"></iframe>
</div>
</body>
</html>