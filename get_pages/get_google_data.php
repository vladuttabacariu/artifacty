<?php
include_once('simple_html_dom.php');
//echo $_GET['provenience'].'asd';

$provenience = str_replace(" ",",",preg_replace("/\([^)]+\)/","",explode('|',$_GET['provenience'])[0]));
//echo $provenience.'a';
$section = $_GET['section'];
$html = file_get_html('https://maps.google.com/maps/api/geocode/xml?address='.$provenience.'&sensor=false&key=AIzaSyAxRlTtPHXCqRW4y_4XpqOfUknYqnI0esc');
$getLat = $html->find('location')[0]->childNodes(0)->innertext ;
$getLon = $html->find('location')[0]->childNodes(1)->innertext ;
echo $getLat.','.$getLon.','.$provenience;
?>

