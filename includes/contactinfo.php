<?php
	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/auth.php');

	require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$group1 = "";
	$group2 = "";
	$group3 = "";
	$group4 = "";
	$group5 = "";
	$sql = "SELECT * FROM contactFTE";
	$result = mysqli_query($con, $sql);
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while($row = mysqli_fetch_assoc($result)) {
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
			if($grouping == 0){
				$group1 = 
					'<tr>
						<th>' . $name . '</th>
						<th>' . $location . '</th>
						<th>' . $position . '</th>
						<th>' . $desk_number . '</th>
						<th>' . $cell_number . '</th>

					</tr>' . $group1;
			}
			if($grouping == 1){
				$group1 .= 
					'<tr>
						<th>' . $name . '</th>
						<th>' . $location . '</th>
						<th>' . $position . '</th>
						<th>' . $desk_number . '</th>
						<th>' . $cell_number . '</th>

					</tr>';
			}
			if($grouping == 2){
				$group2 .= 
					'<tr>
						<th>' . $name . '</th>
						<th>' . $location . '</th>
						<th>' . $position . '</th>
						<th>' . $desk_number . '</th>
						<th>' . $cell_number . '</th>

					</tr>';
			}
			if($grouping == 3){
				$group3 .= 
					'<tr>
						<th>' . $name . '</th>
						<th>' . $location . '</th>
						<th>' . $position . '</th>
						<th>' . $desk_number . '</th>
						<th>' . $cell_number . '</th>

					</tr>';
			}
			if($grouping == 4){
				$group4 .= 
					'<tr>
						<th>' . $name . '</th>
						<th>' . $location . '</th>
						<th>' . $position . '</th>
						<th>' . $desk_number . '</th>
						<th>' . $cell_number . '</th>

					</tr>';
			}
			if($grouping == 5){
				$group5 .= 
					'<tr>
						<th>' . $name . '</th>
						<th>' . $location . '</th>
						<th>' . $position . '</th>
						<th>' . $desk_number . '</th>
						<th>' . $cell_number . '</th>

					</tr>';
			}
		}
		echo
			'
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
			<div class="container">
			  <div class="panel-group" id="accordion">
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h4 class="panel-title">
					  <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">Tech Desk</a>
					</h4>
				  </div>
				  <div id="collapse1" class="panel-collapse collapse in">
					<div class="panel-body">
						<table id="contactTable1" class="table table-striped"> 
							<thead>
								<tr>
									<th>Name</th>
									<th>Location</th>
									<th>Position</th>
									<th>Desk Number</th>
									<th>Cell Number</th>
								<tr>
							</thead>
							<tbody>
								'.$group1.'
							</tbody>
						</table>
					</div>
				  </div>
				</div>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h4 class="panel-title">
					  <a data-toggle="collapse" data-parent="#accordion" href="#collapse2">Rapid Response Technicians</a>
					</h4>
				  </div>
				  <div id="collapse2" class="panel-collapse collapse">
					<div class="panel-body">
						<table id="contactTable2" class="table table-striped"> 
							<thead>
								<tr>
									<th>Name</th>
									<th>Location</th>
									<th>Position</th>
									<th>Desk Number</th>
									<th>Cell Number</th>
								<tr>
							</thead>
							<tbody>
								'.$group2.'
							</tbody>
						</table>
					</div>
				  </div>
				</div>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h4 class="panel-title">
					  <a data-toggle="collapse" data-parent="#accordion" href="#collapse3">Enterprise Desktop Team</a>
					</h4>
				  </div>
				  <div id="collapse3" class="panel-collapse collapse">
					<div class="panel-body">
						<table id="contactTable3" class="table table-striped"> 
							<thead>
								<tr>
									<th>Name</th>
									<th>Location</th>
									<th>Position</th>
									<th>Desk Number</th>
									<th>Cell Number</th>
								<tr>
							</thead>
							<tbody>
								'.$group3.'
							</tbody>
						</table>
					</div>
				  </div>
				</div>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h4 class="panel-title">
					  <a data-toggle="collapse" data-parent="#accordion" href="#collapse4">Local Techs</a>
					</h4>
				  </div>
				  <div id="collapse4" class="panel-collapse collapse">
					<div class="panel-body">
						<table id="contactTable4" class="table table-striped"> 
							<thead>
								<tr>
									<th>Name</th>
									<th>Location</th>
									<th>Position</th>
									<th>Desk Number</th>
									<th>Cell Number</th>
								<tr>
							</thead>
							<tbody>
								'.$group4.'
							</tbody>
						</table>
					</div>
				  </div>
				</div>
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h4 class="panel-title">
					  <a data-toggle="collapse" data-parent="#accordion" href="#collapse5">Other</a>
					</h4>
				  </div>
				  <div id="collapse5" class="panel-collapse collapse">
					<div class="panel-body">
						<table id="contactTable5" class="table table-striped"> 
							<thead>
								<tr>
									<th>Name</th>
									<th>Location</th>
									<th>Position</th>
									<th>Desk Number</th>
									<th>Cell Number</th>
								<tr>
							</thead>
							<tbody>
								'.$group5.'
							</tbody>
						</table>
					</div>
				  </div>
				</div>
			  </div> 
			</div>
			</body>
			</html>
			';
		
	}
?>