<?php

// $data = file_get_contents("http://localhost/1basics/employee_retrive.php");
// print_r($data);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "employee";//put your database name here
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
die("Connection failed: " . mysqli_connect_error());
}
?>