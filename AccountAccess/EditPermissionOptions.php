<?php

require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/SuperuserAuth.php');
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

//to_print is a concatonation of forms that allow for the editing / deleting for each existing permission option.
$to_print = '<!-- begin to_print -->
		<div class="panel-group" id="accordion">';

// Query selects all existing perm names, ordered alphabetically
$permSQL = "
SELECT *
FROM td_perm_names LEFT JOIN td_perm_processes USING(process_id)
ORDER BY perm_name ASC;
";
$perm_result = mysqli_query($con, $permSQL);

if (mysqli_num_rows($perm_result) > 0) {
	// If rows exist, loop through them
	while ($g_row = mysqli_fetch_assoc($perm_result)) {
		//Set row vars
		$perm_name = $g_row['perm_name'];
		$perm_id = $g_row['perm_id'];
		$process_id = $g_row['process_id'];
		$process_desc = $g_row['process_desc'];
		// concat form field onto to_print
		$to_print .= '
					<div class="well well-sm">
						<div class="row field-row">
							<div class="col-sm-9">
								<div class="input-group">
									<div class="input-group-addon removeBtn">
										<a class="btn btn-link sidebtn" onclick="parent.confirmDelete(' . $perm_id . ');">
											<span class="glyphicon glyphicon-remove"></span>
										</a>
									</div>
                                <input class="form-control" type="text" name="perm' . $perm_id . '" value="' . $perm_name . '">
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<select class="form-control" name="process'.$perm_id.'" required>
									'. genOptions($process_id)
									.'</select>
								</div>
							</div>
						</div>
					</div>
					';
	}
	$to_print .= '';
} else {
	echo "ERROR: no response groups found.";
}
function genOptions($process_id){
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$toPrint = "<option value=\"\">-- Select Process --</option>
		";
	$sql = "
	SELECT *
	FROM td_perm_processes
	ORDER BY process_desc ASC;
	";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) {
		// If rows exist, loop through them
		while ($row = mysqli_fetch_assoc($result)) {
			if($row['process_id'] == $process_id){
				$toPrint .= "<option value=\"{$row['process_id']}\" selected >{$row['process_desc']} </option>
				";
			}else{
				$toPrint .= "<option value=\"{$row['process_id']}\">{$row['process_desc']}</option>
				";
			}
		}
	}
	return $toPrint;
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Permission Options</title>
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
	<link rel="stylesheet" type="text/css" href="https://tdta.stthomas.edu/sweetalert-master/dist/sweetalert.css">
	<script src="https://tdta.stthomas.edu/sweetalert-master/dist/sweetalert.min.js"></script>
	<script src="https://tdta.stthomas.edu/js/alerts.js"></script>
	<link rel="stylesheet" href="//tdta.stthomas.edu/styles/editpermissions.css">
	<script src="edit_permission_scripts.js"></script>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>
<div class="container">
	<div class="row content">
		<div class="col-md-1 text-left">
			<!-- White space on left 1/12th of the page -->
		</div>

		<!-- Begin main page body -->
		<div class="col-md-10 text-left">
			<!-- Page header and description -->
			<div class="row">
				<h1>Edit Permission Options</h1>
				<p>
					Below is a list of all of the permission options available to Tech Desk student workers. You can
					perform the following actions:
				</p>
				<ul>
					<li><b>Add Option:</b> enter in a unique name and click the green + sign.</li>
					<li><b>Change Option:</b> make any changes and click "Submit Changes" above.</li>
					<li><b>Delete Option:</b> click the red X next to the option.</li>
				</ul>
			</div>
			<!-- Cancel and Submit buttons -->
			<div class="row grouprow" style="margin-bottom: 15px;">
				<div class="btn-group btn-group-justified" role="group" aria-label="...">
					<div class="btn-group" role="group">
						<a target="_self" href="https://tdta.stthomas.edu/AccountAccess/ViewPermissions.php"
						   class="btn btn-default"><span style="color: black;"
														 class="glyphicon glyphicon-arrow-left"></span> Return</a>
					</div>
					<div class="btn-group" role="group">
						<button class="btn btn-default" type="submit" form="allPermsForm"><span style="color: black;"
																							 class="glyphicon glyphicon-ok"></span>
							Submit Changes
						</button>
					</div>
				</div>
			</div>
			<!-- Row containing header info -->
			<div class="row">
				<div class="row field-row">
					<div class="col-sm-9">
						<h3 style="margin-bottom: 5px">Permission Name</h3>
					</div>
					<div class="col-sm-3">
						<h3 style="margin-bottom: 5px;">Process</h3>
					</div>
					</div>
			</div>
			<!-- Row containing all permission options and blank field for new option. -->
			<div class="row">
				<!-- New permission option -->
				<form id="newPermForm" method="post" action="newPermOption.php" target="iFrame">
					<div class="well well-sm">
						<div class="row field-row">
							<div class="col-sm-9">
								<div class="input-group">
									<div class="input-group-addon newBtn">
										<button class="btn btn-link sidebtn" type="submit">
											<span class="glyphicon glyphicon-plus"></span>
										</button>
									</div>
									<input type="text" class="form-control" name="newPerm" placeholder="New Permission Option" required>
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									<select class="form-control" name="newProcess" required>
										<?php echo genOptions(-1); ?>
									</select>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- All currently existing options -->
				<form id="allPermsForm" method="post" action="modifyPermOptions.php" target="iFrame"
					<?php echo $to_print; ?>
				</form>
			</div>
			<!-- iFrame that is the target for both forms -->
			<iframe name="iFrame" width="100%" height="257px" frameBorder="1" marginwidth="0px" scrolling="no"
					style="display:none;"></iframe>

		</div> <!--End div for main section-->

		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>

	</div> <!-- End div for Row Content -->
</div>
</body>
</html>