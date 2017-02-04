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
	<style>
		body {
			padding-right: 5px;
		}
		h2 {
			margin: 0px;
			padding: 0px;
		}
	</style>
</head>
<body>
<?php
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');
	$cur_user = $_SESSION['username'];
	$sql = "SELECT * FROM genericResponse WHERE username LIKE '$cur_user';";
	$result = mysqli_query($con, $sql);
	$printConcat = '';
	if (mysqli_num_rows($result) > 0) {
		$printConcat ='<div class="well well-sm" style="text-align: center;">You can create and delete your generic responses <a style="margin-top: 5px;" href="https://140.209.47.120/genericresponses/EditResponses.php" target="_parent">here</a>.</div>
	<div class="panel-group" id="accordion">';
		while($row = mysqli_fetch_assoc($result)) {
			$id = $row['id'];
			$title = html_entity_decode($row['title']);
			$msg_body = html_entity_decode($row['msg_body']);
			$printConcat =  $printConcat . '
	<div class="panel panel-default">
		<div class="panel-heading">
			<h4 class="panel-title">
			<a data-toggle="collapse" data-parent="#accordion" href="#'.$id.'">
			'.$title.'</a>
			</h4>
		</div>
		<div id="'.$id.'" class="panel-collapse collapse">
			<div class="panel-body">'.$msg_body.'
			</div>
		</div>
	</div>';
		}
	} else {
		$printConcat = '<br><div class="well" style="text-align: center;"> <p>You don\'t have any generic responses! You can create a generic email template <a style="margin-top: 5px;" href="https://140.209.47.120/genericresponses/EditResponses.php" target="_parent">here</a>.</p></div>';
	}
	echo $printConcat . '</div>';
?>


</body>
</html>
