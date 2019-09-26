<!-- employee_delete_process.php -->
<?php
include_once 'basic_db_connection.php';
mysqli_query($conn,"DELETE FROM employee WHERE userid='" . $_GET["userid"] . "'");
echo "Data delete sucessfully";
header('Location:employee_retrive.php');
?>