<?php 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php"); 
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/AdminAuth.php"); 
?>

<!-- 
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html lang="en">
<head>
<title>Oops!</title>
<?php 
		include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
		fullHeader();
	?>
</head>
<body style="text-align: center;">
	<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/navbar.php');
	?>
<h1>Under Construction</h1>
<p>There isn't anything here yet!</p>
<p><a href="https://140.209.47.120/assistant.php">Return home.</a></p>
<img src="dev/binfa.jpg" alt="Mountain View" style="width:304px;height:450px;">
<?php 
	include ($_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php');
	?>
</body>
</html>