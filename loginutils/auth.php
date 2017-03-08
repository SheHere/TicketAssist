<?php
session_start();
if(!isset($_SESSION["username"])){
header("Location: https://140.209.47.120/index.php");
exit(); }
?>
