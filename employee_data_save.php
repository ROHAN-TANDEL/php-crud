=<!-- employee_data_save -->
<?php
include_once 'basic_db_connection.php';
if(isset($_POST['save']) || 1)
{
	// variables for input data
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$city_name = $_POST['city_name'];
	$email = $_POST['email'];
error_log($first_name);

	$image = $_FILES['image']['tmp_name'];
	$name = $_FILES['image']['name'];

	$img = file_get_contents($image);

	error_log($_SERVER['DOCUMENT_ROOT']);

	$target_path = $_SERVER['DOCUMENT_ROOT'] . "/1basics/" . basename($_FILES['image']['name']);

	move_uploaded_file($image, $target_path);
	// sql query for inserting data into database

	mysqli_query($conn,"insert into employee(first_name,last_name,city_name,email,file) values ('$first_name','$last_name','$city_name','$email','$target_path')") or die(mysqli_error());

	echo "<p align=center>Data Added Successfully.</p>";
	$last_id = mysqli_insert_id($conn);

	$sql = "insert into image (image,name) values(?,'$last_id')";

	$stmt = mysqli_prepare($conn,$sql);

	mysqli_stmt_bind_param($stmt, "s",$img);

	mysqli_stmt_execute($stmt);

	$check = mysqli_stmt_affected_rows($stmt);

	if($check==1){
	$msg = 'Image Successfullly UPloaded';
	}else{
	$msg = 'Error uploading image';
	}
	mysqli_close($conn);
}

header('Location:employee_retrive.php');

?>