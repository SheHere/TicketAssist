<?php
//Ends current session and redirects to the login page
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: ../index.php"); // Redirecting To Home Page
}
?>