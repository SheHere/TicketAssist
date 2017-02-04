<?php require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$toDismiss = $_GET['id'];
	$sql = "UPDATE `notifications` SET `viewed` = 0 WHERE `notifications`.`id` = $toDismiss;";
	$result = mysqli_query($con, $sql);
	if(!$result){
		echo '<script>parent.parent.warningAlert("Unable to dismiss notification. Please contact an administrator.","https://140.209.47.120/assistant.php"); </script>';
	}
	else{
		
	}
?>
<script>
	parent.location.reload(true);
</script>