<?php
if(isset($_POST['email'])) 
{
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
   // $email_to = "roysubhra1998@gmail.com";
    $email_to = "senbihan@gmail.com";
    $email_subject = "Integration 2019 Query ";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
    if(!isset($_POST['name']) ||
        !isset($_POST['email']) ||
        !isset($_POST['subject']) ||
        !isset($_POST['msg'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 
     
 
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH); 
    $email_from = filter_var($_POST['email'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $msg = filter_var($_POST['msg'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
	if(!preg_match($email_exp,$email_from)) {
    	$error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  	}
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  	if(!preg_match($string_exp,$name)) {
    	$error_message .= 'The Name you entered does not appear to be valid.<br />';
  	}
 
 
 	 if(strlen($msg) < 2) {
 	   $error_message .= 'The Message you entered do not appear to be valid.<br />';
 	 }
 
  	if(strlen($error_message) > 0) {
    	died($error_message);
  	}
 
    $email_message = "Integration 2019, Response from Contact Form.\n\n";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email_from)."\n";
    $email_message .= "Message: ".clean_string($msg)."\n";
 
    $email_subject .= ": ".clean_string($subject)."\n";
    
    //echo $email_message;
   

    $headers = 'From: '.$email_from."\r\n". 'Reply-To: '.$email_from."\r\n" . 'X-Mailer: PHP/' . PHP_VERSION;
    if (mail($email_to, $email_subject, $email_message, $headers)){  
    	echo "<p> email sent </p>";
	}
	else{
		echo "<p> something went wrong </p>";
	}

    header("Location: http://www.isical.ac.in/~integration/index.html");
}
?>
