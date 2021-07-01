<?php
$conn = mysqli_connect("localhost","root","1234","myblog");
 
// Check connection
if (mysqli_connect_error())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>