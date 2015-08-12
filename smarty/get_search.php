<?php
$q=stripslashes($_POST['search']);

switch($_POST['engine']) {
	case 1:
    $data="http://torrents.sumotorrent.com/searchResult.php?search=$q";
    break;
	case 2:
     $data="http://torrent-finder.com/show.php?q=$q";
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
	  echo "Wrong Search!Sorry.";
	  break;
}
header("Location: $data");


?>

