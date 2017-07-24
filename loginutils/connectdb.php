<?php
/*
 * Connects to the database. Credentials are stored on the Desktop in config.php
 */
include '/home/projectlocal/Desktop/config.php';
// Sets $con, which is a variable that points to the db connection.
$con = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);
// Throws error if unable to connect
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>