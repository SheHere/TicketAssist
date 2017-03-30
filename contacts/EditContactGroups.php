<?php
//TODO: delete groups, move files from /settings/admin

require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/SuperuserAuth.php');
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

//to_print is going to be printed at the end.

$to_print = '
        <div class="row grouprow" style="margin-bottom: 15px;">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <a target="_self" href="https://140.209.47.120/contacts/contactinfo.php" class="btn btn-default"><span style="color: black;" class="glyphicon glyphicon-remove"></span> - Cancel</a> 
                </div>
                <div class="btn-group" role="group">
                    <button class="btn btn-default" type="submit" form="groupForm"><span style="color: black;" class="glyphicon glyphicon-ok"></span> - Submit Changes</button>
                </div>
            </div>
        </div>
        ';

$to_print .= '
		<div class="panel-group" id="accordion">';

$contact_groupsSQL = "SELECT * from contact_groups ORDER BY ordering ASC";
$cg_result = mysqli_query($con, $contact_groupsSQL);


if (mysqli_num_rows($cg_result) > 0) {
	// If rows exist, create toggles for them. Then populate those toggles with entries from contactFTE and user (for students).
	while ($cg_row = mysqli_fetch_assoc($cg_result)) {
		//Looping through all contact_groups
		$group_name = $cg_row['group_name'];
		$group_id = $cg_row['id'];
		$group_order = $cg_row['ordering'];

		//Disable the ability to edit/remove the groups Students and Other/Unassigned
		$inputQualifier = " required ";
		$btnQualifier = '';
		if ($group_id < 3) {
			$btnQualifier = " disabled ";
			$inputQualifier = " disabled ";
		}
		$to_print .= '
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
						    <label class="sr-only" for="inlineFormInputGroup">New Group</label>
                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                                <div class="input-group-addon removeBtn"><a ' . $btnQualifier . 'class="btn btn-link sidebtn" onclick="parent.confirmDelete(\'https://140.209.47.120/assistant/assistant.php\', \'https://140.209.47.120/contacts/deleteRespGroup.php\', ' . $group_id . ');"><span class="glyphicon glyphicon-remove"></span></a></div>
                                <input class="form-control" type="text" name="group' . $group_id . '" value="' . $group_name . '" ' . $inputQualifier . '>
                            </div>
						</h4>
					</div>
				</div>
					';
	}
	$to_print .= '';
} else {
	echo "ERROR: no contact groups found!";
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
			font-size: 13px;
		}

		th {
			font-weight: normal;
			word-wrap: break-word;
		}

		thead > tr > th {
			font-weight: bold;
			word-wrap: break-word;
		}

		.container {
			padding-left: 3px;
			padding-right: 3px;
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
	<form id="groupForm" method="post" action="updateGroups.php" target="iFrame">
		<?php echo $to_print; ?>
	</form>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
				<form id="newForm" class="form-inline" method="post" action="newGroup.php" target="iFrame">
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