<?php
require "twiliorest.php";

$ApiVersion = "2008-08-01";

$user_id= $_GET['userid'];
$AccountSid = "YOURACCNTID";
$AuthToken = "YOURTOKEN";


$client = new TwilioRestClient($AccountSid, $AuthToken);


mysql_connect("myserverlocalhost","dbuser","dbdpwd");
 mysql_select_db("twliodb");



$result=mysql_query("select * from clients where id = '$user_id'") or die(mysql_error());
while($row = mysql_fetch_array($result)){


$mobile = $row["mobile"];
$first_name= $row["first_name"];
$last_name= $row["last_name"];
$name= $first_name."".$last_name;


        $response = $client->request("/$ApiVersion/Accounts/ $AccountSid /SMS/Messages",
            "POST", array(
            "To" => $mobile,
            "From" => "YYY-YYY-YYYY",
            "Body" => "Hello $name! Please, don't forgot switch off the light at our office."
        ));
        if($response->IsError)
            echo "Error: {$response->ErrorMessage}";
        else
            echo "Sent message to $name";

    }?>

