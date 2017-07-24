<?php
/*
 * Prevents those who are not signed in from accessing this page.
 *
 * Also prevents users who are not Admins from accessing this page.
 */
session_start();
if($_SESSION["admin_status"] < 3){
header("Location: http://tdta.stthomas.edu/ImproperCredentials.php");
exit();}
?>