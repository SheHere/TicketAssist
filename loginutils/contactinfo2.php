<?php
	/*
		In progress 2/23/17 - DON"T TOUCH THIS CHASE
	*/

	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/auth.php');
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	
	//to_print is going to be printed at the end. 
	$to_print = '
	<div class="container">
		<div class="panel-group" id="accordion">';
	
	$contact_groupsSQL = "SELECT * from contact_groups ORDER BY ordering ASC";
	$cg_result = mysqli_query($con, $contact_groupsSQL);

	
	if(mysqli_num_rows($cg_result) > 0) {
		// If rows exist, create toggles for them. Then populate those toggles with entries from contactFTE and user (for students).
		while($cg_row = mysqli_fetch_assoc($cg_result)) {
			//Looping through all contact_groups
			$group_name = $cg_row['group_name'];
			$group_id = $cg_row['id'];
			$group_order = $cg_row['ordering'];
			$in = '';
			if($group_order == 1){
				$in = ' in ';
			}
			$to_print .= '
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapseID'.$group_id.'">'.$group_name.'</a>
						</h4>
					</div>
					<div id="#collapseID'.$group_id.'" class="panel-collapse collapse'.$in.'">
						<div class="panel-body">
							<table id="contactTableID'.$group_id.'" class="table table-striped"> 
					';
			
			//Students have their contact information in a different table, so they cannot be treated like FTEs
			if(strcmp('Students', $group_name) == 0){
				$contactSQL = "SELECT fname, lname, phone_number FROM users WHERE phone_number != '' ORDER BY lname ASC;";
				$contact_result = mysqli_query($con, $contactSQL);
				if (mysqli_num_rows($contact_result) > 0) {
					$to_print .='
					<thead>
						<tr>
							<th>Name</th>
							<th>Cell Number</th>
						<tr>
					</thead>
					<tbody>';
					while($stu_row = mysqli_fetch_assoc($contact_result)) {
						//Looping through all students contact info
						$fname = $stu_row['fname'];
						$lname = $stu_row['lname'];
						$phone_num = $stu_row['phone_number'];
						$to_print .= '
						<tr>
							<th>'.$fname.' '.$lname.'</th>
							<th>'.$phone_num.'</th>
						</tr>
						';
					}
					$to_print .= '
								</tbody>
							</table>
						</div>
					</div>
				</div>';
				}
			}else{
				$contactFTESQL = "SELECT * FROM contactFTE WHERE grouping = $group_id;";
				$contactFTE_result = mysqli_query($con, $contactFTESQL);
				if (mysqli_num_rows($contactFTE_result) > 0) {
					$to_print .='
					<thead>
						<tr>
							<th>Name</th>
							<th>Position</th>
							<th>Location</th>
							<th>Desl Number</th>
							<th>Cell Number</th>
						<tr>
					</thead>
					<tbody>';
					while($row = mysqli_fetch_assoc($contactFTE_result)) {
						//Looping through all contactFTE
						$id = $row['id'];
						$grouping = $row['grouping'];
						$name = $row['full_name'];
						$location = $row['location'];
						$position = $row['position'];
						$desk_number = $row['desk_number'];
						$cell_number = $row['cell_number'];
						if(strcmp($cell_number,'') == 0){
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
					$to_print .= '
								</tbody>
							</table>
						</div>
					</div>
				</div>';
				}
			}
		}
		echo '</div>
		</div>';
	}else{
		echo "ERROR: no contact groups found!";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		th {
			font-weight: normal;
		}
		thead > tr > th {
			font-weight: bold;
		}
		.container {
			padding-left: 0px;
			padding-right: 0px;
		}
	</style>
</head>
<body>
	<?php echo $to_print; ?>
</body>
</html>