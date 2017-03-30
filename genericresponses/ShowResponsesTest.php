<?php

require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/auth.php');
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

//to_print is going to be printed at the end.
if($_SESSION['admin_status'] > 1){$superusertext = '';}else{$superusertext='';}
$to_print = '
    <div class="panel-group" id="accordion1">';

$groupsSQL = "SELECT * from genericResponseGroups ORDER BY ordering ASC";
$groupResult = mysqli_query($con, $groupsSQL);


if (mysqli_num_rows($groupResult) > 0) {
    // If rows exist, create toggles for them. Then populate those toggles with entries from contactFTE and user (for students).
    while ($g_row = mysqli_fetch_assoc($groupResult)) {
        //Looping through all contact_groups
        $group_name = $g_row['group_name'];
        $group_id = $g_row['id'];
        $group_order = $g_row['ordering'];

        $to_print .= '
				<div class="panel panel-default" >
					<div class="panel-heading" >
						<h2 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion1" href="#collapseID' . $group_id . '">' . $group_name . '</a>
						</h2>
					</div>
					<div id="collapseID' . $group_id . '" class="panel-collapse collapse">
						<div class="panel-body">
					';

        //Students have their contact information in a different table, so they cannot be treated like FTEs
        $sql = "SELECT * FROM genericResponse WHERE grouping = $group_id ORDER BY title;";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
            $to_print .= '<div class="panel-group" id="accordion" style="margin-top: 10px;">';
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                $title = html_entity_decode($row['title']);
                if ($_SESSION['admin_status'] > 1) {
                    $title .= '<a style="float: right;" href="https://140.209.47.120/genericresponses/EditResponses.php?id=' . $id . '"><span class="glyphicon glyphicon-pencil"></span></a>';
                }
                $msg_body = html_entity_decode($row['msg_body']);
                $to_print = $to_print . '
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion2" href="#' . $id . '">
                            ' . $title . '</a>
                        </h4>
                    </div>
                    <div id="' . $id . '" class="panel-collapse collapse">
                        <div class="panel-body">
                            
                            <div id="tocopy'.$id.'">' . $msg_body . '</div>
                            
                        </div>
                    </div>
                </div>';
            }
            $to_print .= '</div></div></div></div>';
        } else {
            $to_print .= '<br><div class="well" style="text-align: center;"> <p>Oops! There are no generic responses available. Superusers can create and delete generic responses <a href="https://140.209.47.120/genericresponses/EditResponses.php" target="_parent">here</a>.</p>
                        </div></div></div></div>';
        }
    }
    $to_print .= '</div>';
}else{
    echo "ERROR: no contact groups found!";
}
?>
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
		body > .container {
			padding: 15px 15px 15px 15px;
		}
		h2 {
			margin: 0px;
			padding: 0px;
		}
	</style>
</head>
<body>
<div class="container">
<div class="row">
	<div class="col-xs-6" style="padding-left: 0;">
		<h1>Generic Responses</h1>
	</div>
	<div class="col-xs-6 text-right">
		<h1><button id="infobutton" class="btn btn-link" type="button" onclick="parent.infoAlert('The following are email templates that should be copied directly into tech notes when appropriate to be sent to clients. Please use these instead of writing your own messages so that we can have greater consistancy in our communication!');"><i style="color:black;" class="fa fa-question-circle fa-2x aria-hidden="true"></i></button></h1>
	</div>
</div>
<?php if($_SESSION['admin_status'] > 1){
echo '<div class="row" style="margin-bottom: 15px;">
	<div class="btn-group btn-group-justified" role="group" aria-label="...">
		<div class="btn-group" role="group">
			<a href="https://140.209.47.120/genericresponses/EditResponses.php" class="btn btn-default"><span class="glyphicon glyphicon-pencil"></span> - New Response</a> 
		</div>
		<div class="btn-group" role="group">
			<a href="https://140.209.47.120/genericresponses/EditResponses.php?tab=remove" class="btn btn-default"><i style="color:black;" class="fa fa-bomb fa-1x" aria-hidden="true"></i> - Delete Responses</a>
		</div>
		<div class="btn-group" role="group">
			<a href="https://140.209.47.120/hostedpages/underconstruction.php" class="btn btn-default"><i style="color:black;" class="fa fa-arrows-v fa-1x aria-hidden="true"></i> - Edit Groups</a>
		</div>
	</div>
</div>';} ?>
<div class="row">
<?php echo $to_print; ?>
</div>
</div>
</body>
</html>