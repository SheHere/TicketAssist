<?php
/*
 * Prevents those who are not signed in from accessing this page.
 */
session_start();
if(!isset($_SESSION["username"])){
header("Location: https://tdta.stthomas.edu/index.php");
exit(); }
?>
