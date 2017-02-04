<?php
session_start();
if($_SESSION["admin_status"] < 3){
header("Location: http://140.209.47.120/ImproperCredentials.php");
exit();}
?>