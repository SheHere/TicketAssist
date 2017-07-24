<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php");
	include 'badge_functions.php';

	$inCreator = true;
	if (isset($_GET['badge'])) {
		$inCreator = false;
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
<?php
	if ($inCreator) {
		echo '<title>Badge Creator</title>';
	} else {
		echo '<title>Badge Manager</title>';
	}

	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	datatablesHeader();
?>

	<link rel="stylesheet" href="../styles/badges.css">

	<script>
		//Configures the datatable so that it targets the table, order by descending, sets it to a frame so that we can see the buttons at the bottom without scrolling to them.
		$(document).ready(function() {
			$('#iconTable').DataTable({
				scrollY: '65vh',
				scrollCollapge: true,
				columnDefs: [{width: '5%', targets: 0}],
				paging: false
			});

			var userTable = $('#userTable').DataTable({
				scrollY: '43vh',
				scrollCollapge: true,
				columnDefs: [{width: '5%', targets: 0}],
				paging: false
			});

			$("#userForm").submit(function(e) {
				e.preventDefault();
				userTable
					.search('')
					.columns().search('')
					.draw();

				successAlert("Badge updated!", "http://tdta.stthomas.edu/badges/badge_index.php");
				document.getElementById("userForm").submit();
			});
		});
</script>
</head>
<body>

<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/includes/navbar.php");
?>
	<div class="container-fluid">
		<div class="col-md-12 col-sm-12">
			<?php
			if ($inCreator) {
				echo '<form id="userForm" action="badge_form_handler.php" method="post" target="form_target">';
			} else {
				echo '<form id="userForm" action="badge_form_handler.php?badge=' . $_GET['badge'] . '" method="post" target="form_target">';
			}
			?>
				<div class="col-md-6">
					<div class="row">
						<h1>1. Select the icon</h1>
						<table id="iconTable" class="display table table-striped" width="100%">
							<thead>
								<tr>
									<th>Select</th>
									<th>Name</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($inCreator) {
									populateIconTableCreator();
								} else {
									populateIconTableEditor($_GET['badge']);
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-1"></div>
				<div class="col-md-5">
					<div class="row">
						<h1>2. Enter the name</h1>
						<?php
						if ($inCreator) {
							echo '<input type="text" class="form-control" name="nameInput" id="nameInput" placeholder="Badge name" required>';
						} else {
							$name = getName($_GET['badge']);
							echo '<input type="text" class="form-control" name="nameInput" id="nameInput" placeholder="Badge name" value="' . $name . '" required>';
						}
						?>
					</div>
					<div class="row">
						<h1>3. Enter the prerequisites</h1>
						<?php
						if ($inCreator) {
							echo '<input type="text" class="form-control" name="prerequisiteInput" id="prerequisiteInput" placeholder="Badge prerequisites" required>';
						} else {
							$prerequisites = getPrerequisites($_GET['badge']);
							echo '<input type="text" class="form-control" name="prerequisiteInput" id="prerequisiteInput" placeholder="Badge prerequisites" value="' . $prerequisites . '" required>';
						}
						?>
					</div>
					<div class="row">
						<h1>4. Select recipients</h1>
						<table id="userTable" class="display table table-striped" width="100%">
							<thead>
								<tr>
									<th>Select</th>
									<th>Name</th>
								</tr>
							</thead>
							<tbody>
								<?php
								if ($inCreator) {
									populateUserTableCreator();
								} else {
									populateUserTableEditor($_GET['badge']);
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="col-md-12 col-sm-12">
					<button type="submit" class="btn btn-block btn-custom">
					<?php
					if ($inCreator) {
						echo 'Create badge';
					} else {
						echo 'Update badge';
					}
					?>
					</button>
				</div>
			</form>
			<iframe src="#" class="form_target" id="form_target" name="form_target" style="display: none;"></iframe>
		</div>
	</div>
	<div class="footer">
	<?php
		include($_SERVER['DOCUMENT_ROOT'] . "/includes/footer.php");
	?>
	</div>
</body>
</html>
