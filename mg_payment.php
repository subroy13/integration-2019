<?php

if(isset($_GET['id']))
{
    $id = $_GET['id'];
}

ini_set('display_errors', 1);
echo "<html>
<title> MathGeek | Integration 2019 </title>
<link rel='icon' href='./img/integration_logo_icon.ico'>
<body>

  <br> <h2><font face='verdana'><center>INTEGRATION 2019</center></font></h2> 
    <center><img src='./img/Integration_logo.png' width='88' height='80'></center> <br/>
    <center><h2><u>MathGeek, 2019</u></h2></center>
    <center><h3>Registration Details</h3></center>
    <br/><br/>
";


else{
    require_once('connect.php');
    
    //$_SESSION["roll_no"] = $roll_no;
    $table_name = 'MG_USER'
    //$query = 'SELECT * from '. $table_name . ' where EMAIL = "' . $id . '"';
    echo $query;
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
            $name = $row["NAME"];
            $email = $row["EMAIL"];
            //$addr = nl2br($row["POSTAL_ADDR"]);
            $school_addr = nl2br($row["ORG"]);
            $phno = $row["PH_NO"];
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
                <td>Email Address: </td>
                <td>$email </td>
            </tr>
            <tr>
                <td>School/College: </td>
                <td>$school_addr</td>
            </tr>
            <tr>
                <td>Phone Number: </td>
                <td>$phno</td>
            </tr>
        </table>
        </center>
        <br/><br/> 
    
    You have successfully registered. Please continue the payment of registration fees to get your username and password. <br/>
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
