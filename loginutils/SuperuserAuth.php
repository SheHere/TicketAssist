<?php
session_start();
if($_SESSION["admin_status"] < 2){
header("Location: http://140.209.47.120/ImproperCredentials.php");
exit();}
?>