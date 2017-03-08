<?php 
include '/home/projectlocal/Desktop/config.php';

$con = mysqli_connect(HOST, USERNAME, PASSWORD, DB_NAME);

if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>