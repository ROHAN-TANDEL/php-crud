<!-- employee_data_insert -->
<!DOCTYPE html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<html>
<body>
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
</body>
<script type="text/javascript">

function callback() {
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
/*
$.ajax({
         url: "http://localhost/PlatformPortal/Buyers/Account/SignIn",
         data: { signature: authHeader },
         type: "GET",
         beforeSend: function(xhr){xhr.setRequestHeader('X-Test-Header', 'test-value');},//or 
         success: function() { alert('Success!' + authHeader); }
      });
*/
</script>
<?php
/*
$ch = curl_init( $url );
# Setup request to send json via POST.
$payload = json_encode( array( "customer"=> $data ) );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
# Return response instead of printing.
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );.

#stopping return value from curlresponse and dump data for $results
#curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
#curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);

# Send request
$result = curl_exec($ch);
curl_close($ch);
# Print response.
echo "<pre>$result</pre>";

#another way for curl
$ch = curl_init();
$curlConfig = array(
    CURLOPT_URL            => "http://www.example.com/yourscript.php",
    CURLOPT_POST           => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS     => array(
        'field1' => 'some date',
        'field2' => 'some other data',
    )
);
curl_setopt_array($ch, $curlConfig);
$result = curl_exec($ch);
curl_close($ch);

*/
</html>