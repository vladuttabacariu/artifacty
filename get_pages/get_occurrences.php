<?php
include('../includes/config.php');
include_once('simple_html_dom.php');
$data="";
$section = str_replace(" " ,"_",$_GET['section']);
$stmt_get_proveniences = $db->prepare('SELECT distinct(provenience) as prov FROM get_section WHERE curatorial_section LIKE concat("%",:section,"%")  ORDER BY rand()' );
$stmt_get_proveniences->bindParam(":section", $section, PDO::PARAM_STR);
$stmt_get_proveniences->execute();
$row = $stmt_get_proveniences->fetch(PDO::FETCH_ASSOC);
while ($row = $stmt_get_proveniences->fetch(PDO::FETCH_ASSOC)) {
	$stmt_get_occurrences = $db->prepare('SELECT count(distinct(object_name)) as occur FROM '.$section.' WHERE provenience LIKE concat("%",:provenience,"%")  ORDER BY provenience' );
	$stmt_get_occurrences->bindParam(":provenience", $row['prov'], PDO::PARAM_STR);
	$stmt_get_occurrences->execute();
	$row2 = $stmt_get_occurrences->fetch(PDO::FETCH_ASSOC);
	if($row2['occur']>20){
		$html = file_get_html('http://maps.google.com/maps/api/geocode/xml?address='.str_replace(" ",",",explode('|',$row['prov'])[0]).'&sensor=false');
		
		if($html->find('status')[0]->innertext=='OK'){
			$getLat = $html->find('location')[0]->childNodes(0)->innertext ;
			$getLon = $html->find('location')[0]->childNodes(1)->innertext ;
			$data .= $row['prov'].','.$row2['occur'].','.$getLat.','.$getLon.',';
		}
	}
	
}
echo $data;

?>