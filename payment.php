<?php

session_start();
if(isset($_GET['id']))
{
    $roll_no = $_GET['id'];
}

ini_set('display_errors', 1);
echo "<html>
<title> MTRP | Integration 2019 </title>
<link rel='icon' href='./img/integration_logo_icon.ico'>
<body>

  <br> <h2><font face='verdana'><center>INTEGRATION 2019</center></font></h2> 
    <center><img src='./img/Integration_logo.png' width='88' height='80'></center> <br/>
    <center><img src='images/oxford_logo.jpg' width='150' height='80'></center>
    <center><h2><u>Mathematics Talent Reward Programme, 2019</u></h2></center>
    <center><h3>Registration Details</h3></center>
    <br/><br/>
";

$re = '/^MTRP19\/(DP|CC|CO|WG|BG)\/(IX|XI)\/\d{4}/m';
if(!preg_match($re, $roll_no))
{
    echo "<h4><center> Ooops!! Some Error has occurred! </center></h4>";
    echo "    <br/><br/><br/><br/> 
    </body>
    </html>";
}

else{
    require_once('connect.php');
    
    $_SESSION["roll_no"] = $roll_no;
    list($mtrp, $venue, $class, $id) = explode('/', $roll_no);
    $table_name = $venue . "_" . $class;

    $query = 'SELECT * from '. $table_name . ' where ROLL_NO = ' . (int)($id);
    $result = $con->query($query);
    if(!$result || $result->num_rows == 0)
    {
    	echo "<h4><center> Ooops!! Some Error has occurred! Contact us with your query. </center></h4>";
    	echo "    <br/><br/><br/><br/> 
    	</body>
    	</html>";
             
    }
    else{
        
        while($row = $result->fetch_assoc()) 
        {
            $name = $row["name"];
            $email = $row["email"];
            $addr = nl2br($row["POSTAL_ADDR"]);
            $school_addr = nl2br($row["SCHOOL_ADDR"]);
            $phno = $row["PHONE_NO"];
	    $version = $row["LANG_MED"];
            if($version == "en")
		$ver = "English";
	    else $ver = "Bengali";
	    $primer = $row["PRIMER"];
            if(empty($primer)) $primer = "No**";
	}
        echo"
        <center>
        <p>
        <table style='border-collapse: separate;border-spacing: 8 1em;'>
            <tr>
                <td>Name: </td>
                <td>$name </td>
            </tr>
            <tr>
                <td>Class: </td>
                <td>$class </td>
            </tr>
            <tr>
                <td>Email Address: </td>
                <td>$email </td>
            </tr>
            <tr>
                <td>Postal Address: </td>
                <td>$addr</td>
            </tr>
            <tr>
                <td>School Name & Address: </td>
                <td>$school_addr</td>
            </tr>
            <tr>
                <td>Phone Number: </td>
                <td>$phno</td>
            </tr>
            <tr>
                <td>Preferred Medium: </td>
                <td>$ver</td>
            </tr>
            <tr>
                <td>Include Problem Primer: </td>
                <td>$primer</td>
            </tr>
        </table>
        </center>
        <br/><br/> 
    
    You have successfully registered. Please continue the payment of registration fees to get your admit card. <br/>
    * Please ignore the examination fee if you have already paid and obtained your admit. <br/>
    ** For all earlier registration by default this value is 'No'. You can still get the Problem Primer.<br/>
    <strong> Postal Delivery charge of the Problem Primer is to be paid by the candidate. </strong>
    <br/><br/>
    </body>
    </html>";


echo "
    <script>
    function getPreFilledDataTS(){
        return {
            eventcode:    'mathematics-talent-reward-programme-2019-141424',
            name:         '$name',
            emailid:      '$email',
            cq1:          '$roll_no'
        }
    }
    </script>
    <center>
    <button onclick='popupWithAutoFill(getPreFilledDataTS());' class='tsbutton'>Pay Registration Fee</button>
    </center>
    <noscript id='tsNoJsMsg'>Javascript on your browser is not enabled.</noscript>
    <script src='https://www.townscript.com/popup-widget/townscript-widget.nocache.js' type='text/javascript'></script>";
    $con->close();

    }
    
}
?>
