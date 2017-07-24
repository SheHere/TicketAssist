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
	<script src="//tdta.stthomas.edu/third-party-packages/MaskedInput.js" type="text/javascript"></script>
	<script>
        jQuery(function($){
            $("#deskphone").mask("9-9999");
            $("#cellphone").mask("(999) 999-9999");
        });
	</script>
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
            <?php if(isset($_GET['id'])){echo '<h1>Edit Contact</h1>';}else{echo '<h1>New Contact</h1>';} ?>
            <form id="contactUpdateForm" action="modifyContactEntry.php" method="post" target="contactiFrame">
                <div class="form-group">
                    <label for="contactFullName"><span style="color: red;">*</span>Full Name:</label>
                    <input type="text" class="form-control" name="contactFullName" placeholder="e.g. John Doe" value="<?php echo $full_name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" class="form-control" name="location" placeholder="e.g. St. Paul / Minneapolis" value="<?php echo $location; ?>">
                </div>
                <div class="form-group">
                    <label for="position">Position:</label>
                    <input type="text" class="form-control" name="position" placeholder="e.g. Grunt Labor" value="<?php echo $position; ?>">
                </div>
                <div class="form-group">
                    <label for="dnumber">Desk Number Extension:</label>
                    <input type="text" class="form-control" id="deskphone" name="dnumber" placeholder="2-3456" value="<?php echo $desk_number; ?>">
                </div>
                <div class="form-group">
                    <label for="cnumber">Cell Number:</label>
                    <input type="text" class="form-control" id="cellphone" name="cnumber" placeholder="(999) 321-5555" value="<?php echo $cell_number; ?>">
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
                    <label for="selectGrouping"><span style="color: red;">*</span>Group:</label>
                    <select class="form-control" name="selectGrouping" required>
                        <option value="">----</option>
						<?php echo $options; ?>
						<?php if(isset($_GET['id'])){echo '<option style="color:red;" value ="-2">Remove Contact</option>';} ?>
                    </select>
					<?php if(isset($_GET['id'])){echo '<p><b>Note:</b> selecting "Remove Contact" will permanently delete this entry.</p>';} ?>
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
