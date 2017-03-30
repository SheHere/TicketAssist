<?php
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/SuperuserAuth.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Edit Contact</title>
	<?php
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>

</head>
<body>

<!-- Creates the navbar, see file for details and modification -->
<?php
include $_SERVER["DOCUMENT_ROOT"] . '/includes/navbar.php';

$toEdit = $_GET['id'];
$query = "SELECT * FROM contactFTE WHERE id = $toEdit";
$result = mysqli_query($con,$query);
if(mysqli_num_rows($result) == 1){
	$row = mysqli_fetch_assoc($result);
	$id = $row['id'];
	$full_name = $row['full_name'];
	$location = $row['location'];
	$position = $row['position'];
	$desk_number = $row['desk_number'];
	$cell_number = $row['cell_number'];
	$grouping = $row['grouping'];
}
?>

<div class="container-fluid text-center">
	<div class="row content">
		<div class="col-md-1 text-left">
			<!-- White space on left 1/12th of the page -->
		</div>
		<div class="col-md-10 text-left">
			<h1>Edit Contact</h1>
			<form id="contactUpdateForm" action="modifyContactEntry.php" method="post" target="contactiFrame">
				<div class="form-group">
					<label for="contactFullName">Full Name:</label>
					<input type="text" class="form-control" name="contactFullName" value="<?php echo $full_name; ?>">
				</div>
				<div class="form-group">
					<label for="location">Location:</label>
					<input type="text" class="form-control" name="location" value="<?php echo $location; ?>">
				</div>
				<div class="form-group">
					<label for="position">Position:</label>
					<input type="text" class="form-control" name="position" value="<?php echo $position; ?>">
				</div>
				<div class="form-group">
					<label for="dnumber">Desk Number:</label>
					<input type="text" class="form-control" name="dnumber" value="<?php echo $desk_number; ?>">
				</div>
				<div class="form-group">
					<label for="cnumber">Cell Number:</label>
					<input type="text" class="form-control" name="cnumber" value="<?php echo $cell_number; ?>">
				</div>

				<?php
				$group_sql = "SELECT * FROM `contact_groups` ORDER BY ordering;";
				$group_result = mysqli_query($con, $group_sql);
				$options = '';
				if(mysqli_num_rows($group_result) > 0){
					while($group_row = mysqli_fetch_assoc($group_result)){
						$selected = '';
						if($group_row['id'] == $grouping){$selected = ' selected ';}
						$options .= '
									<!-- Grouping: '.$grouping.' --><option value="'.$group_row['id'].'"'.$selected.'>'.$group_row['group_name'].'</option>';
					}
				}
				?>
				<div class="form group">
					<label for="selectGrouping">Group</label>
					<select class="form-control" name="selectGrouping" required>
						<option value="">----</option>
						<?php echo $options; ?>
						<option value="-1">Hidden</option>
						<option value ="-2">Removed</option>
					</select>
				</div>
				<input type="hidden" name="contactID" value="<?php echo $id; ?>">
				<br>
				<button type="submit" class="btn btn-custom">Submit</button>
			</form>
			<br>
			<iframe align="left" name="contactiFrame" id="contactiFrame" width="500" height="300" frameBorder="0" marginwidth="0" style="visibility: block;"></iframe>


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
