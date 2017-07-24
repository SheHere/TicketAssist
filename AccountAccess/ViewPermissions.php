<?php
//include($_SERVER["DOCUMENT_ROOT"] . "/loginutils/AdminAuth.php");
include($_SERVER['DOCUMENT_ROOT'] . '/AccountAccess/permission_backend.php');

if(isset($_GET['user'])){
	$user = $_GET['user'];
}else{
	$user = "";
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
	<title> TD Permissions Form </title>
	<?php
	include($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	datatablesHeader();
	?>
	<script src="../third-party-packages/MaskedInput.js" type="text/javascript"></script>
	<script src="permission_scripts.js"></script>
	<style>
		.btn-custom {
			margin-top: 10px;
			margin-bottom: 25px;
		}

		.footer_text {
			position: relative;
			bottom: 0;
			z-index: 2;
		}
	</style>

	<!-- Configures the datatable so that it targets the table, order by descending, sets it to a frame so that we can see the buttons at the bottom without scrolling to them. -->
	<script>
        $(document).ready(function() {
            var userTable = $('#userTable').DataTable({
                scrollY: '60vh',
				scrollX: '100%',
                scrollCollapge: true,
                bPaginate: false
            });

            $('[data-toggle="tooltip"]').tooltip();

            $("#userForm").submit(function(e) {
                e.preventDefault();
                userTable
                    .search('')
                    .columns().search('')
                    .draw();
                document.getElementById("userForm").submit();
            });
        });
	</script>
</head>
<body>
<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>
<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
			<a href="EditPermissionOptions.php">Edit Permission Options</a>
		</div>

		<div class="col-md-10 text-left">
			<div class="row">
				<div class="col-xs-12">
					<h1>User Permissions</h1>
					<table id="userTable" class="display table table-striped table-bordered">
						<thead>
						<tr>
							<th>Username</th>
							<th>Name</th>
							<th>Change Permissions</th>
							<?php populateTableColumns(); ?>
						</tr>
						</thead>
						<tbody>
						<?php populateTableRows(); ?>
						</tbody>
					</table>
				</div>
			</div>

		</div> <!--End div for main section-->
		<div class="col-md-1 text-left">
			<!-- White space on right 1/12th of the page  -->
		</div>
		<br><br><br><br><br>

	</div> <!-- End div for Row Content -->
</div><!--End div for Bootstrap container rules-->

<?php
include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php';
?>

</body>
</html>
