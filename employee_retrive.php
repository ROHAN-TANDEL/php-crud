<!-- employee_retrive.php -->
<?php
error_reporting(E_ERROR | E_PARSE);
include_once 'basic_db_connection.php';
$result = mysqli_query($conn,"SELECT * FROM employee");
?>

<!DOCTYPE html>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<title> Retrive data</title>
<style type="text/css">
table * input {
	border: none;
}
table {
font-family: arial, sans-serif;
border-collapse: collapse;
width: 100%;
}
td, th {
border: 1px solid #dddddd;
text-align: left;
padding: 8px;
}
tr:nth-child(even) {
background-color: white;
}
</style>
</head>

<body>
	<form name="formSubmit" id="formSubmit"  action="" enctype="multipart/form-data">
<table id="form_table">
<tr>
<td>First Name</td>
<td>Last Name</td>
<td>City</td>
<td>Email id</td>
<td>Profile Pic</td>

<td>Action1</td>
<td>Action2</td>
</tr>
<?php
$i=0;
/*var_dump($result);
exit;*/
while($row = mysqli_fetch_array($result)) {
if($i%2==0)
$classname="even";
else
$classname="odd";
?>

<tr id="<?php echo $row['userid'];?>" class="<?php if(isset($classname)) echo $classname;?>">
<td class="<?php echo $row['userid'];?>"><input id="frow<?php echo $row['userid']; ?>" type="text" name="first_name" value="<?php echo $row["first_name"]; ?>"/></td>
<td class="<?php echo $row['userid'];?>"><input id="lrow<?php echo $row['userid']; ?>" type="text" name="last_name" value="<?php echo $row["last_name"]; ?>"/></td>
<td class="<?php echo $row['userid'];?>"><input id="crow<?php echo $row['userid']; ?>" type="name" name="city_name" value="<?php echo $row["city_name"]; ?>"/></td>
<td class="<?php echo $row['userid'];?>"><input id="erow<?php echo $row['userid']; ?>" type="email" name="email" value="<?php echo $row["email"]; ?>"></td>

<td class="<?php echo $row['userid']?>"> 
<?php 

$user_id = $row['userid'];

$res=mysqli_query($conn,"SELECT * FROM image WHERE name=$user_id");

$row1=mysqli_fetch_array($res);
//print_r($row1);
//die($row1);
if ($row1['image']=="") {
	$a ='<img src="'. "http://localhost:81/employee/default.jpg".'" height="50" width="50"/>';
} else {
$a ='<img src="data:image/jpeg;base64,'.base64_encode($row1['image'] ).'" height="50" width="50"/>';
}
?>
<?php echo $a; ?>
</td>

<td class="<?php echo $row['userid'];?>"><a id="update<?php echo $row['userid'];?>" href="#" onclick="row_update(<?php echo $row["userid"]; ?>);">Update</a></td>

<td class="<?php echo $row['userid'];?>"><a href="#" onclick="row_delete(<?php echo $row["userid"]; ?>);">Delete</a></td>

</tr>
<?php
$i++;
}
?>
<td id="add_employee_link"><a href="#" onclick="newData();">New Emplyee</a></td>
</table>
<div id="add_employee" style="display: none">

	<form name="formSubmit" id="formSubmit"  action="" enctype="multipart/form-data">
		First name:
		<input type="text" name="first_name">
		Last name:
		<input type="text" name="last_name">

		City name:
		<input type="text" name="city_name">

		Email Id:
		<input type="email" name="email">
		Profile Pic:
		<input type="file" name="image">
		<input type="button" name="save" value="submit" onClick="callback()"/>
	</form>

</div>
</form>
</body>
<script type="text/javascript">

function callback() {

	document.getElementById("add_employee").style.display = "none";
			document.getElementById("add_employee_link").style.display = "block";
// All create the message
var str = $("#formSubmit").serialize();
	var form = $('form')[0];
	var formData = new FormData(form);
	
	console.log(str);
		for (var value of formData.values()) {
	   console.log(value); 
	}

$.ajax({

type: "POST",
url: "employee_data_save.php",
data: formData,
cache: false,
contentType: false,
processData: false,

success: function sata(gappa, status) {
	console.log(gappa);
	$("html").html(gappa);
	 //window.location.href = "employee_retrive.php";
}	

});

}

	function newData() {
			document.getElementById("add_employee").style.display = "block";
			document.getElementById("add_employee_link").style.display = "none";
	}

function row_update(userid) {

var check = document.getElementById("update"+userid).innerHTML;

if (check == "Update") {

	$("table #"+userid+" > ."+userid+"> input").css( "border", "1px black solid" );
	document.getElementById("update"+userid).innerHTML = "save";	
	var check = document.getElementById("update"+userid).innerHTML;

	return false;
}

document.getElementById("update"+userid).innerHTML = "Update";
$("table #"+userid+" > ."+userid+"> input").css( "border", "0px black solid" );

var first_name = document.getElementById('frow'+userid).value;
var last_name = document.getElementById('lrow'+userid).value;
var city_name = document.getElementById('crow'+userid).value;
var email = document.getElementById('erow'+userid).value;


var name = first_name+last_name+city_name+email;
console.log(name);
//alert(name);
	$.ajax ({
		type: "POST",
		url: "employee_update_process.php?userid="+userid,
		data: {'userid':userid,'first_name':first_name,'last_name':last_name,'city_name':city_name,'email':email},
		success: function done(yp) {
			console.log(yp);
		},
		error: function erroe(yappo) {
			console.log(yappo);
		}
	});
}

function row_delete(userid) {

	$.ajax ({
		type: "GET",
		url: "employee_delete_process.php?userid="+userid,
		//data: {'userid':userid},
		success: function done(yp) {
		document.getElementById(userid).outerHTML="";
			console.log(yp);
		},
		error: function erroe(yappo) {
			console.log(yappo);
		}
	});

}
</script>
</html>
