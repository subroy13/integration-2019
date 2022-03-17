<?php

if(isset($_GET['code']))
{
    if($_GET['code'] == 1)    // Duplicate Data
    {
        $name = $_GET['name'];
        $email = $_GET['email'];
        $type = 'Already Registered';
        $msg = "The name '$name' and email '$email' is already registered with us! If you have any query contact us via mail/phone. Thank you.";
    }

    if($_GET['code'] == 2)    // Duplicate Data
    {
        $name = $_GET['name'];
        $email = $_GET['email'];
        $type = 'Not Registered';
        $msg = "The name '$name' and email '$email' is not registered with us! If you have any query contact us via mail/phone. Thank you.";
    }
    if($_GET['code'] == 3)
	{
            $type = 'Form Submission Error';
            $msg = '';
	}
    if($_GET['code'] == 4)
	{
		$type = 'Session Expired';
		$msg = 'Your session has been expired. If you have completed your payment, please mail at mtrp.isi.kolkata@gmail.com for your admit card. Write "Admit Card" as subject and mention your name, registered email, class and venue in the email text.';
	}
}
echo"<html>
    <br/><br/>
    <h1>ERROR</h1><br/>
    <h3>$type</h3>
    <p>$msg</p>
    </html>";
?>
