<?php
//PHP class to extraction of email address from Web pages///
//+++++++++++++++++++++++++++++++++++++++++++++++++++++++///
// This code was done by Alexander Urov
//30/06/10
// version 0.1
//aurov@odesk.com
///+++++++++++++++++++++++++++++++++++++++++++++++++++++///


class EmailAgent {

private $headers;  //cURL headers setting
private $agent;  //cURL  user agent which simulated browser
private $data; //data source
private $template; //template of the Reqular expresission for the search
private $geturl; //URL path to source Web page


function EmailAgent() {
//method what make the initialization cURL settings
$this->agent = "Mozilla/5.0 (Windows; U; Windows NT 5.1; ru-RU; rv:1.7.12) Gecko/20050919 Firefox/1.0.7";

$this->headers [] = "Accept: text/html;q=0.9, text/plain;q=0.8, image/png, */*;q=0.5" ;
$this->headers [] = "Accept_charset: windows-1251, utf-8, utf-16;q=0.6, *;q=0.1";
$this->headers [] = "Accept_encoding: identity";
$this->headers [] = "Accept_language: en-us,en;q=0.5";
$this->headers [] = "Connection: close";
$this->headers [] = "Cache-Control: no-store, no-cache, must-revalidate";
$this->headers [] = "Keep_alive: 300";
$this->headers [] = "Expires: Thu, 01 Jan 1970 00:00:01 GMT";

}


function getData($url) {
//method creates and process the cURL session and get data
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $this->agent);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
curl_setopt ($ch,CURLOPT_VERBOSE, 1 );
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$html = curl_exec($ch);
if (!$html) {
	echo "<br />cURL error number:" .curl_errno($ch);
	echo "<br />cURL error:" . curl_error($ch);
	exit;
}
else{
curl_close($ch);
return $html;
}
}


function emailGrabber($data) {
//method which process data by regular expression rule
$this->template="/[a-z0-9]+([_\\.-][a-z0-9]+)*@([a-z0-9]+([\.-][a-z0-9]+)*)+\\.[a-z]{2,}/i";
preg_match_all($this->template,$data,$matches);
foreach(array_unique($matches[0]) as $email) {
      echo $email . "<br />";
}

}

public function main ($url) {
//this method uses to launch the class object
$agent=new EmailAgent();
$this->geturl=$url;
$data=$agent->getData($this->geturl);
$agent->emailGrabber($data);

}



}

?>

