<?php require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$toDismiss = $_GET['id'];
	$sql = "UPDATE `notifications` SET `dismissed` = 0 WHERE `notifications`.`id` = $toDismiss;
	UPDATE `notifications` SET `viewed` = 0 WHERE `notifications`.`id` = $toDismiss;";
	$result = mysqli_multi_query($con, $sql);
	if(!$result){
		echo '<script>parent.parent.warningAlert("Unable to dismiss notification. Please contact an administrator.","https://tdta.stthomas.edu/assistant/assistant.php"); </script>';
	}
	else{
		
	}
?>
<script>
	parent.location.reload(true);
</script>