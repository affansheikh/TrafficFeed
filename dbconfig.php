<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "TrafficFeed";
date_default_timezone_set("Asia/Karachi");
$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  # code...
  die("Error in Connection...".mysqli_connect_error());
}
?>