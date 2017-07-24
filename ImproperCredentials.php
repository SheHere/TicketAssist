<?php include $_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"; ?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
  <title> Oops! </title>
<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
	fullHeader();
	?>
</head>
<body>

<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php';
?>
  
<div class="container-fluid text-center">    
	<div class="row content">
		<div class="col-md-1 text-left"> 
		<!-- White space on left 1/12th of the page -->
		</div>
	 
		<div class="col-md-10 text-left"> 
		
			<h1>Oops!</h1>
			<p>You do not have the proper admin level to view this page.</p>
			<p>Your status is set to:
			<?php
				if($_SESSION['admin_status'] == 1){
					echo " <strong>User</strong>. You have basic access to most pages.";
				}else{
					if($_SESSION['admin_status'] == 2){
						echo " <strong>Superuser</strong>. You have enahnced access to most pages.";
					}else{
						if($_SESSION['admin_status'] == 3){
							echo " <strong>Admin</strong>. You have complete access to all pages. If you are seeing this page, something is broken.";
						}else{
							echo "<strong>Error</strong>. No admin status found.";
						}
					}
				}
			?>
			</p>
			<p>If you think this is a mistake, contact an administrator.</p>
			</h3><a href="http://tdta.stthomas.edu/assistant/assistant.php">Return home.</a></h3>
			
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
