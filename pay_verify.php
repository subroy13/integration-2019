<?php

require('connect.php');
$name = $_POST['name'];
$email = $_POST['email'];
$class = $_POST['class'];
$venue = $_POST['venue'];
$phno = $_POST['ph_no'];

$table_name = $venue . "_" . $class;

$test_query = 'SELECT * from ' . $table_name . ' WHERE PHONE_NO = "' .$phno.'" AND EMAIL = "' . $email .'"';
$res = $con->query($test_query);
if($res->num_rows == 0 || $res->num_rows > 1)
{
    $con->close();
    header('location: error.php?code=2&name='.$name.'&email='.$email);
}
else{

    while($row = $res->fetch_assoc()) 
    {
        $roll_id = $row["ROLL_NO"];
    }

    
    $id_str = sprintf("%'.04d\n", $roll_id);
    $roll_no = 'MTRP19/'. $venue .'/'.$class.'/'.$id_str;
    header('location: payment.php?id='.$roll_no);
}


?>
