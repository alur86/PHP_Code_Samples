<?php

include 'Dropbox/autoload.php';
require_once 'Dropbox.php';



$consumerKey = '4345435636dffr2455';
$consumerSecret = '442342342343254asa';




session_start();


$oauth = new Dropbox_OAuth_PHP($consumerKey, $consumerSecret);

$dropbox = new Dropbox_API($oauth);

$account = $dropbox->getAccountInfo();

echo $account;


$tokens = $dropbox->getToken('mytest@emaailaddress.com', 'wowpassword');

$_SESSION["oauth_tokens"]=$tokens;

$oauth->setToken($oauth_tokens);

$metaData = $dropbox->metaData();

if ($file_type = $data->mime_type !="jpeg/image") {

break;
}


 foreach ($metaData['body']->contents as $data) {
      if ($file_type = $data->mime_type !="jpeg/image") {
        break;
          }

      $file_size = $data->size;
      $file_path = $data->path;
       echo $file_path;
       echo "<br>";
       echo $file_size;
       echo "<br>";
       echo $file_type;
       echo "<br>";

}


 session_destroy();


?>

