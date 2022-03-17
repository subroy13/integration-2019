<?php
function db_connect() {

        // Define connection as a static variable, to avoid connecting more than once 
    static $con;
        // Try and connect to the database, if a connection has not been established yet
    if(!isset($con)) {
             // Load configuration as an array. Use the actual location of your configuration file
        $config = parse_ini_file('./config_files/config.ini'); 
        $con = mysqli_connect($config['servername'],$config['username'],$config['password'],$config['dbname']);
    }   

        // If connection was not successful, handle the error
    //if($con === false) {
            // Handle error - notify administrator, log to a file, show an error screen, etc.
    //    return $con;
	//return mysqli_connect_error(); 
    //}   
    return $con;
}

// Connect to the database
$con = db_connect();

// Check connection
if (!$con) {
    //echo "here";
    die("Connection failed: " . mysqli_connect_error());
}
// echo "connected successfully";
?>
