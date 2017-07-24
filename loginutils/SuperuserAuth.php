<?php
/*
 * Prevents those who are not signed in from accessing this page.
 *
 * Also prevents users who are not Admins or Superusers from accessing this page.
 */
session_start();
if($_SESSION["admin_status"] < 2){
header("Location: http://tdta.stthomas.edu/ImproperCredentials.php");
exit();}
?>