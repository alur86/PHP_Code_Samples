<?php

global $body;
$sBasePath ="/fckeditor/";
$oFCKeditor = new FCKeditor('FCKeditor') ;
$oFCKeditor->BasePath = $sBasePath ;

$oFCKeditor->Width  = '100%' ;
$oFCKeditor->Height = '600' ;

if ( isset($_GET['Lang']) )
{
	$oFCKeditor->Config['AutoDetectLanguage']	= false ;
	$oFCKeditor->Config['DefaultLanguage']		= $_GET['Lang'] ;
}
else
{
	$oFCKeditor->Config['AutoDetectLanguage']	= true ;
	$oFCKeditor->Config['DefaultLanguage']		= 'en' ;
}

$oFCKeditor->Value =$body;

$oFCKeditor->Create() ;


?>

