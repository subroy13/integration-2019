<?php
//parse_ini_file('../config_files/config.ini');
//$con = mysqli_connect($config['servername'],$config['username'],$config['password'],$config['dbname']);
require('connect.php');
/*******YOU DO NOT NEED TO EDIT ANYTHING BELOW THIS LINE*******/    

function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : false;
}

ini_set('display_errors', 1);
//create MySQL connection   
if(isset($_POST["venue"])){
    $venue = $_POST["venue"];
}
if(isset($_POST["class"])){
    $class = $_POST["class"];
}

$table_name = $venue . "_" . $class;
$query = 'SELECT * from '. $table_name ;

$file_ending = "xls";
$filename='MTRP_Candidates_' . $table_name;
if($result = mysqli_query($con, $query))
{

//header info for browser
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename.xls");  
header("Pragma: no-cache"); 
header("Expires: 0");
/*******Start of Formatting for Excel*******/   
//define separator (defines columns in excel & tabs in word)
$sep = "\t"; //tabbed character
//start of printing column names as names of MySQL fields
for ($i = 0; $i < mysqli_num_fields($result); $i++) {
echo mysqli_field_name($result,$i) . "\t";
}
print("\n");    
//end of printing column names  
//start while loop to get data
    while($row = mysqli_fetch_row($result))
    {
        $schema_insert = "";
        for($j=0; $j<mysqli_num_fields($result);$j++)
        {
            if(!isset($row[$j]))
                $schema_insert .= "NULL".$sep;
            elseif ($row[$j] != "")
                $schema_insert .= "$row[$j]".$sep;
            else
                $schema_insert .= "".$sep;
        }
        $schema_insert = str_replace($sep."$", "", $schema_insert);
        $schema_insert = preg_replace("/\r\n|\n\r|\n|\r/", " ", $schema_insert);
        $schema_insert .= "\t";
        print(trim($schema_insert));
        print "\n";
    }
}   
?>
