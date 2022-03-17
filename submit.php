<?php

require_once('connect.php');

ini_set('display_errors', 1);

if(!(isset($_POST['name']) && 
      isset($_POST['guard_name']) &&
      isset($_POST['email']) &&
      isset($_POST['class']) &&
      isset($_POST['phno'])) ) 
{
 header('location:error.php?code=3');
}

$name = $con->real_escape_string($_POST['name']);
$guard_name = $con->real_escape_string($_POST['guard_name']);
$email = $con->real_escape_string($_POST['email']);
$class = $con->real_escape_string($_POST['class']);
$phone_no = $con->real_escape_string($_POST['phno']);
$postal_addr = $con->real_escape_string($_POST['post_addr']);
$medium = $con->real_escape_string($_POST['medium']);
$school_addr = $con->real_escape_string($_POST['school_addr']);
$venue = $con->real_escape_string($_POST['venue']);
$primer = $con->real_escape_string($_POST['primer']);

//echo $name, $guard_name, $email, $class, $phone_no, $postal_addr, $medium, $school_addr, $venue;
$table_name = $venue . "_" . $class;

$test_query = 'SELECT * from ' . $table_name . ' WHERE name = "' .$name.'" AND email = "' . $email .'"';
$res = $con->query($test_query);
if($res->num_rows > 0)
{
    //$con->close();
    header('location: error.php?code=1&name='.$name.'&email='.$email);
}
else{
	$insert_query = 'insert into ' . $table_name . '(name, GUARD_NAME, email, PHONE_NO, POSTAL_ADDR, LANG_MED, SCHOOL_ADDR, PRIMER)'.
            ' VALUES (\'' . $name . "','" . $guard_name . "','" . $email . "','" . $phone_no . "','" . $postal_addr . 
            "','" . $medium . "','" . $school_addr . "','" . $primer . "');";

	//echo $query;             
    
    if ($con->query($insert_query) === TRUE) {
    	$id = $con->insert_id;
    	$id_str = sprintf("%'.04d\n", $id);
    	$roll_no = 'MTRP19/'. $venue .'/'.$class.'/'.$id_str;
    	  header('location: payment.php?id='.$roll_no);
	} 
	else {
    	   echo "Error: <br>" . $con->error;
	}

	$con->close();
}
?>
