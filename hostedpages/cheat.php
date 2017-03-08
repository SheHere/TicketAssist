<?php
	include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
?>

<!--
<--- Created by Nick Scheel and Chase Ingebritson 2016
<---
<--- University of St. Thomas ITS Tech Desk
--->

<!DOCTYPE html>
<html>
<head>
	<?php 
		include ($_SERVER['DOCUMENT_ROOT'] . '/includes/createHeader.php');
		reducedHeader();
	?>
</head>
<body>
<p>This is a cheap way to extend the timeout!</p>
<script>
		setInterval(function(){window.location.reload(true);}, 100000);
</script>
</body>
</html>
