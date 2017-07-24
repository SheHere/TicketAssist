<?php
// Prevent non-users from accessing and connect to db
include($_SERVER['DOCUMENT_ROOT'] . "/loginutils/auth.php");
require($_SERVER['DOCUMENT_ROOT'] . '/loginutils/connectdb.php');

//create query
$query = "SELECT * FROM orgTree ORDER BY id;";
$result = mysqli_query($con,$query);
if(!$result) {
	//Insert something that would happen if the information was not placed in
	return 1;
}else{
	//create empty array
	$temparray = array();
	while($row = mysqli_fetch_assoc($result)){
		$temparray[] = $row;
	}
	echo '{ "class": "go.TreeModel",
                    "nodeDataArray": [' . json_encode($temparray) . ']}';
	mysqli_close($con);
}