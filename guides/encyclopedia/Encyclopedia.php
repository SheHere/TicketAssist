<?php include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Encyclopedia</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/r-2.1.0/se-1.2.0/datatables.min.css"/>
  <link rel="stylesheet" href="../../styles/assistant.css">
  <style>
    
    .footer{
    	padding-top: 30px;
	}
  </style>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.6/jqc-1.12.3/dt-1.10.12/b-1.2.2/b-colvis-1.2.2/r-2.1.0/se-1.2.0/datatables.min.js"></script>
		<!-- Configures the datatable so that it targets the table, order by descending, sets it to a frame so that we can see the buttons at the bottom without scrolling to them. -->
  <script> 
		$(document).ready(function() {
				$('#encyclopediaTable').DataTable({
					scrollY: '55vh',
					scrollCollapge: true,
					columnDefs: [{width: '5%', targets: 0}]
				});
			} );
  </script>
  
  
</head>
<body>

<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
?>
  
<div class="container-fluid text-center">    
  <div class="row content">
	<!--
	---- Begin main section, which will call the HTML from the input file
	--->
    <div class="col-md-10 text-left"> 
      
		<h1>Encyclopedia</h1>
		
		<!-- 
		---- The classe "sortable" calls .js file that allows the table to be sorted, the class "table" is a Bootstrap
		---- class that formats it nicely, and "table-striped" is a Bootstrap class that makes every-other entry
		---- a gray color so each entry stands out better.
		-->
		<form id="entryForm" action="flagEntry.php" method="post" target="iFrame">		
			<table id="encyclopediaTable" class="display table table-striped"> 
				<thead>
					<tr>
						<th>Select</th>
						<th>Term</th>
						<th>Topic</th>
						<th>Description</th>
						<th>Guide</th>
						<th>Keywords</th>
					</tr>
				</thead>
				<tbody>
				<?php 
				/*
					The following PHP send a request to the database looking for each log entry that belongs to the current user.
					It displays them in descending order by ID, which is also by most recent. 
					It will not show log entries with a visibility of 0, ones that have been "deleted".
				*/
					require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
					$username = $_SESSION['username'];
					$output = "";
					$sql = "SELECT * FROM encyclopedia";
					$result = mysqli_query($con, $sql);
					
					$keyword1 = '';
					$keyword2 = '';
					$keyword3 = '';
					$keyword4 = '';
					
					if (mysqli_num_rows($result) > 0) {
						// output data of each row
						while($row = mysqli_fetch_assoc($result)) {
							$count = $row['count'];
							$term = $row['vocab_term'];
							$topic = $row['topic'];
							$description = $row['description'];
							$guide = $row['guide'];
							$guidelink = 'None';
							$guideTitle = str_replace("http://140.209.47.120/guides/Guide.php?guide=", "", $guide);
							if(strcmp('None', $guide) != 0){$guidelink = '<a href="' . $guide . '"> ' . $guideTitle . '</a>';}
							$keyword1 = $row['keyword1'];
							$keyword2 = $row['keyword2'];
							$keyword3 = $row['keyword3'];
							$keywords = "";
							if(strcmp('', $keyword1) != 0){$keywords .= $keyword1;}
							if(strcmp('', $keyword2) != 0){$keywords .= ', ' . $keyword2;}
							if(strcmp('', $keyword3) != 0){$keywords .= ', ' . $keyword3;}
							
							//Status: 0 = hidden, 1=pending admin approval, 2=flagged, 3=approved
							$status = $row['status'];

							if ($status == 2 || $status == 3) {
								/*
								Create table row, populating with information from the entry's relation.
								The <span> below forces the log text to be normal, rather than bolded.
								*/
								$output = '
								<tr>
									<th class="dt-center"> 
										<div class="radio">
											<label class="radio-inline">
												<input type="radio" name="toFlag" value="' . $count . '">
											</label>
										</div>
									</th>
									<th>' . $term . '</th>
									<th>' . $topic . '</th>
									<th><span style="font-weight: normal;">' . $description . '</span></th>
									<th>' . $guidelink . '</th>
									<th>' . $keywords . '</th>
								</tr>' . $output;
							}
						}
						echo $output;
						echo '<input type="hidden" name="flaggedBy" value="'.$_SESSION['username'].'">';
					}
				?>
				</tbody>
			</table>
		<button type="submit" class="btn btn-warning" value="submit" onclick="myFunction();">Flag Selected</button>
		</form>
		<div class="iFrame" id="iFrameDiv" style="display: none; padding-top: 5px;">
			<iframe align="left" name="iFrame" width="100%" height="55px" frameBorder="0" marginwidth="0" scrolling="no"></iframe>
		</div>
		</div> <!--End div for main section-->
	
	<div class="col-md-2 text-left"> 
	
		<h1>About</h1>
		<p>The encyclopedia seen here is an easy way to search for terms that you may not be famililar with. It is completely user created, and relies on user contributions to be as complete as possible.</p>
		<p>If there is incorrect information found here, please select it and flag it for administrative attention.</p>
		<h2><a href="http://140.209.47.120/guides/encyclopedia/newEntry.php">Create New Entry</h2>
	</div>	
  	
  </div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<div class="footer">
<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
?>
</div>
  <script>
		function myFunction() {
		document.getElementById("iFrameDiv").style.display = 'block';
	}
  </script>
</body>
</html>







