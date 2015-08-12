<?php

$url= $_GET['url'];
$link="http://";
$site=$link.$url;
include("domain.class.php");
include("LIB_http.php");
include("LIB_parse.php");
include("LIB_resolve_addresses.php");
include("LIB_exclusion_list.php");
include("LIB_simple_spider.php");
include("LIB_download_images.php");

$domain=new domain($site);


if($domain->is_available()){
$status = "<h3>domain $site is available</h3>";
echo $status;
$data = file_get_contents($site);

$dom = new DOMDocument();
$dom->loadHTML($data);
$xpath = new DOMXPath($dom);
$hrefs = $xpath->evaluate("/html/body//a");

echo "<h3>Results:</h3>";
echo "<br><hr>";


for ($k = 0; $k < $hrefs->length; $k++) {
	$href = $hrefs->item($k);
	$url = $href->getAttribute('href');
	
echo "<br /><b>page".$k."_file=:".$url."</b><br><hr>";
$page = file_get_contents($url);

preg_match('/<title>([^>]*)<\/title>/si', $page, $match );
if (isset($match) && is_array($match) && count($match) > 0)
{
echo "<b>page".$k."_title=:</b>".strip_tags($match[1]);
}
$web_page = http_get($target=$site."".$url, $referer="");
$meta_tag_array = parse_array($web_page['FILE'], "<meta", ">");

for($i=0; $i<count($meta_tag_array); $i++)
    echo"<br /><b>page_var_meta".$k."=:". htmlentities($meta_tag_array[$i])."\n";



$p_array = parse_array($web_page['FILE'], "<p>", "</p>");

 for($j=0; $j<count($p_array); $j++)
    echo"<br /><b>page_var_paragraph".$k."=:". strip_tags($p_array[$j])."\n";
   echo"<br />";


$table_array = parse_array($web_page['FILE'], "<table>", "</table>");

 for($l=0; $l<count($table_array); $l++)
    echo"<br /><b>page_var_table".$k."=:". strip_tags($table_array[$l])."\n";
    echo"<br />";


$img_tag_array = parse_array($web_page['FILE'], "<img", ">");

  for($h=0; $h<count($img_tag_array); $h++)
    echo"<br /><b>page_var_image".$k."=:". htmlentities($img_tag_array[$h])."\n";
    echo"<br />";

}

$link_tag_array = parse_array($web_page['FILE'], "<a", ">");

  for($v=0; $v<count($link_tag_array); $v++)  {
     echo"<br /><b>page_var_image".$k."=:". htmlentities($link_tag_array[$v])."\n";
    echo"<br />";

}

}
else {
$status = "$site is not valid";

}
?>

