<?php
	/*
		In progress 2/23/17 - DON"T TOUCH THIS CHASE
	*/

	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/auth.php');
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	
	//to_print is going to be printed at the end.
    $to_print = '';

    //If they are Superuser, show edit buttons
        $to_print .= '
        <div class="row grouprow" style="margin-bottom: 15px;">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <a href="https://tdta.stthomas.edu/contacts/ContactInfoFullView.php" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> - Edit Contacts</a> 
                </div>
                <div class="btn-group" role="group">
                    <a target="_self" href="https://tdta.stthomas.edu/contacts/EditContactGroups.php" class="btn btn-default"><i style="color:black;" class="fa fa-arrows-v fa-1x aria-hidden="true"></i> - Edit Groups</a>
                </div>
            </div>
        </div>
        ';

	$to_print .= '
		<div class="panel-group" id="accordion">';
	
	$contact_groupsSQL = "SELECT *
FROM contact_groups
ORDER BY ordering, group_name ASC";
	$cg_result = mysqli_query($con, $contact_groupsSQL);

	
	if(mysqli_num_rows($cg_result) > 0) {
		// If rows exist, create toggles for them. Then populate those toggles with entries from contactFTE and user (for students).
		while($cg_row = mysqli_fetch_assoc($cg_result)) {
			//Looping through all contact_groups
			$group_name = $cg_row['group_name'];
			$group_id = $cg_row['id'];
			$group_order = $cg_row['ordering'];
			$in = '';
			if($group_order < 2){
				$in = ' in ';
			}
			$to_print .= '
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseID'.$group_id.'">'.$group_name.'</a>
						</h4>
					</div>
					<div id="collapseID'.$group_id.'" class="panel-collapse collapse'.$in.'">
						<div class="panel-body">
							<table id="contactTableID'.$group_id.'" class="table table-striped"> 
					';
			
			//Students have their contact information in a different table, so they cannot be treated like FTEs
			if(strcmp('Students', $group_name) == 0){
				$contactSQL = "SELECT fname, lname, phone_number FROM users WHERE phone_number != '' ORDER BY lname ASC;";
				$contact_result = mysqli_query($con, $contactSQL);
				if (mysqli_num_rows($contact_result) > 0) {
					$to_print .= '
					<thead>
						<tr>
							<th>Name</th>
							<th>Cell Number</th>
						<tr>
					</thead>
					<tbody>';
					while ($stu_row = mysqli_fetch_assoc($contact_result)) {
						//Looping through all students contact info
						$fname = $stu_row['fname'];
						$lname = $stu_row['lname'];
						$phone_num = $stu_row['phone_number'];
						$to_print .= '
						<tr>
							<th>' . $lname . ', ' . $fname . '</th>
							<th>' . $phone_num . '</th>
						</tr>
						';
					}
				}else{
					$to_print .= "<p>No Contacts!</p>";
				}
					$to_print .= '
								</tbody>
							</table>
						</div>
					</div>
				</div>';

			}else{
				$contactFTESQL = "SELECT * FROM contactFTE WHERE grouping = $group_id;";
				$contactFTE_result = mysqli_query($con, $contactFTESQL);
				if (mysqli_num_rows($contactFTE_result) > 0) {
					$to_print .= '
					<thead>
						<tr>
							<th>Name</th>
							<th>Location</th>
							<th>Position</th>
							<th>Desk Number</th>
							<th>Cell Number</th>
						<tr>
					</thead>
					<tbody>';
					while ($row = mysqli_fetch_assoc($contactFTE_result)) {
						//Looping through all contactFTE
						$id = $row['id'];
						$grouping = $row['grouping'];
						$name = $row['full_name'];
						$location = $row['location'];
						$position = $row['position'];
						$desk_number = $row['desk_number'];
						$cell_number = $row['cell_number'];
						if (strcmp($cell_number, '') == 0) {
							$cell_number = '----';
						}
						$to_print .= '
						<tr>
							<th>' . $name . '</th>
							<th>' . $location . '</th>
							<th>' . $position . '</th>
							<th>' . $desk_number . '</th>
							<th>' . $cell_number . '</th>
						</tr>
						';
					}
				}else{
					$to_print .= "<h3 style='margin-top: 5px; margin-bottom: 5px;' class='text-center'>No Contacts!</h3>";
				}
					$to_print .= '
								</tbody>
							</table>
						</div>
					</div>
				</div>';

			}
		}
		$to_print .= '</div>';
	}else{
		echo "ERROR: no contact groups found!";
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
	</style>
    <base target="_parent">
</head>
<body>
<div class="container">
	<?php echo $to_print; ?>
</div>
</body>
</html>