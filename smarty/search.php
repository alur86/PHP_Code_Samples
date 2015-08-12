<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/index-3.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<!-- InstanceBeginEditable name="doctitle" -->
<title>Torrent Search Engine Searcher - Torrent Search </title>
<meta name="description" content="Torrent Search is a Torrent Search Engine Searcher that scans BitTorrent sites for torrent files.">
<meta name="keywords" content="torrent search, search for torrents, torrent files, bittorrent search, torrent searcher, bittorrent searcher, torrent file search">
<meta name="copyright" content="Torrent Search">
<link href="cssstyles/basic.css" rel="stylesheet" type="text/css" />
<script language="JavaScript" type="text/javascript" src="Templates/js/add_bookmark.js"></script>
<script src="js/lib/jquery.js" type="text/javascript"></script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<script src="js/cmxforms.js" type="text/javascript"></script>

<!-- InstanceEndEditable -->

<style type="text/css">
<!--
.style26 {
	font-size: 24px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
-->
</style>


<style type="text/css">
@import url("cssstyles/basic.css");
body {
	background-image: none;
	background-attachment:fixed;
	background-color: #000000;
	}
.style25 {color: #FFFFFF}
-->
</style>
<script type="text/javascript">
<!--
function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>
</script>
<script type="text/javascript">
$(document).ready(function() {
	$("#search_form").validate();
});
</script>

<style type="text/css">
#search_form label { width: 250px; }
#search_form label.error, #search_form input.submit
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" /></head>

<body leftmargin="0" topmargin="0" rightmargin="0" marginheight="0" marginwidth="0" onload="setDefaults();">
<table width="101%" border="0" cellpadding="0" cellspacing="0">

  
  <tr>
    <td height="26" ><table width="806" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFFFFF">
      <tr>
        <td height="63" valign="middle"><img src="images/icon_torrent.png" alt="Torrent Search" width="48" height="48" />
            <bt>
            <div align="center"></td>
        <td colspan="3" valign="middle"><span class="style26 style25"> TORRENT-SEARCH.US </span></td>
        <td valign="middle"><div align="center">
        <form action="search.php" method="post" name="search_form" class="style3" id="search_form">
        <select name="engine" size="1">
<option value="1" selected>TORRENT SCAN</option>
<option value="2">TORRENT FINDER</option>
<option value="3">NOW TORRENTS</option>
<option value="4">SCRAPE TORRENT</option>
<option value="5">GOOGLE</option>
</select>
          <label for="textfield"></label></td>
        <td colspan="2" valign="middle"><input name="search" type="text" class="required" id="search" size="60" /></td>
        <td valign="middle"><div align="center"><input type="image" class="submit" src="images/search-button.jpg" name="sub" alt="Search" width="89" height="32" srcover="images/search-button.jpg" srcdown="images/search-button1.jpg"></div></td>
      </form> </div>
      </tr>
      <tr>
        <td height="5" valign="middle"></td>
        <td colspan="7" align="right" valign="middle"></td>
      </tr>
      <tr>
        <td width="50" height="26" background="images/Menu-bar.gif"><div align="center"></div></td>
    <td width="100" background="images/Menu-bar.gif" id="menu"><div align="center"><a href="index.php">Home</a></div></td>
    <td width="110" background="images/Menu-bar.gif" id="menu"><div align="center"><a href="torrent-search.php">Torrent Search</a></div></td>
    <td width="100" background="images/Menu-bar.gif" id="menu"><div align="center"><a href="torrent-clients.php">Torrent Clients</a></div></td>
    <td width="123" background="images/Menu-bar.gif" id="menu"><div align="center"><a href="index.php">Torrent Links </a></div></td>
    <td width="110" background="images/Menu-bar.gif" id="menu"><div align="center"><a href="p2p-clients.php">P2P Clients</a></div></td>
  <td width="100" background="images/Menu-bar.gif" id="menu"><div align="center"><a href="index.php">Torrent FAQ</a></div></td>
    <td width="113" background="images/Menu-bar.gif" id="menu"><div align="center"><a href="index.php">
    Bookmark Us 
    </a></div></td>
      </tr>
      <tr>
        <td colspan="8"><!-- InstanceBeginEditable name="EditRegion1" -->
          <table width="100%" border="0" cellspacing="3" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
            <tr>
              <td>&nbsp;
             <?php

$q=stripslashes($_POST['search']);


$engine=intval(($_POST['engine']));


switch($engine) {
	case 1:
    $data="http://torrents.sumotorrent.com/searchResult.php?search=$q";
    break;
	case 2:
     $data="http://torrent-finder.com/show.php?q=$q&target='_blank'";
	  break;
   	case 3:
      $data="http://www.nowtorrents.com/torrents/$q.html";
	  break;
	case 4:
	  $data="http://scrapetorrent.com/Search/index.php?search=$q&sort=seed";
	  break;
	case 5:
	  $data="http://www.google.com/search?q=filetype%3Atorrent+$q";
	  break;
	default:
	  echo "Wrong search happened now, sorry.";
	  break;
}




   ?>




<iframe id="search" src="<?php echo $data; ?>"  scrolling="yes" marginwidth="0" marginheight="0" NORESIZE frameborder="0" vspace="0" hspace="0" WIDTH=800 HEIGHT=750>
</iframe>

              </td>
              <td>&nbsp;</td>
            </tr>
          </table>
          
          
        <!-- InstanceEndEditable --></td>
      </tr>
    </table></td>
  </tr>
</table>

 <div align="center" class="style4 style25">&copy; 2008 Torrent Search. All rights   reserved.</div>
 <br />




</body>
<!-- InstanceEnd --></html>
