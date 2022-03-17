<?php

require_once('connect.php');

ini_set('display_errors', 1);

if(!(isset($_POST['name']) && 
      isset($_POST['email']) &&
      isset($_POST['phno'])) ) 
{
 header('location:error.php?code=3');
}

$name = $con->real_escape_string($_POST['name']);
$email = $con->real_escape_string($_POST['email']);
$phone_no = $con->real_escape_string($_POST['phno']);
$org = $con->real_escape_string($_POST['school_addr']);

//echo $name, $guard_name, $email, $class, $phone_no, $postal_addr, $medium, $school_addr, $venue;
$table_name = 'MG_USER';

$test_query = 'SELECT * from ' . $table_name . ' WHERE NAME = "' .$name.'" AND EMAIL = "' . $email .'"';
$res = $con->query($test_query);
if($res->num_rows > 0)
{
    //$con->close();
    header('location: error.php?code=1&name='.$name.'&email='.$email);
}
else{
	$insert_query = 'insert into ' . $table_name . '(NAME, EMAIL, PH_NO, ORG)'.
            ' VALUES (\'' . $name . "','" .  $email . "','" . $phone_no .  "','" . $org . "');";

	echo $query;             
    
    if ($con->query($insert_query) === TRUE) {
    	$id = $con->insert_id;
    	#$id_str = sprintf("%'.04d\n", $id);
    	#3$roll_no = 'MTRP19/'. $venue .'/'.$class.'/'.$id_str;
    	header('location: mg_payment.php?id='.$email);
	} 
	else {
    	   echo "Error: <br>" . $con->error;
	}

	$con->close();
}
?>
