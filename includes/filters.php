<?php
echo '<div class="filters_label">Filter artifacts by provenience, culture, material or date made</div>';
echo '<div class="filters">';
//filter for provenience
if(isset($_GET['section'])){
	$stmt_filter_region = $db->prepare('SELECT distinct(provenience) as prov FROM get_section WHERE curatorial_section LIKE concat("%",:section,"%")  ORDER BY provenience' );				
	$stmt_filter_region->bindParam(":section", $sectionName, PDO::PARAM_STR);
	$stmt_filter_region->execute();
	echo '<label class="select_label">';
	echo '<select class="select id="provenience_select" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" name="region">';
	echo '<option value="region.php?section='.$sectionName.'&region=-1&culture=-1&material=-1"> Provenience </option>';
	while ($row = $stmt_filter_region->fetch(PDO::FETCH_ASSOC)){		
		$prov2 = preg_replace("/\([^)]+\)/","",$row['prov']);
		$prov = trim($prov2);
		if($prov!=""){
			if(strcmp(strtolower($regionName),strtolower($prov))==0){
				$selected=" selected";
			}
			else
			{
				$selected="";
			}
			echo '<option value="region.php?section='.$sectionName.'&region='.$prov.'"'.$selected.'>'.$prov.'</option>';
		}
	}
	echo '</select>';
	echo '</label>';
}
//
//filter for culture
$stmt_filter_culture = $db->prepare('(SELECT DISTINCT(substring(culture,1,CASE WHEN instr(culture,"(")=0 THEN CASE WHEN instr(culture,"|")=0 THEN LENGTH(culture) ELSE instr(culture,"|")-1 END ELSE instr(culture,"(")-1 END)) as cult FROM '.$sectionName.' WHERE (CASE WHEN :region <> - 1 THEN provenience LIKE concat("%",:region,"%") ELSE 1=1 END) ORDER BY culture)' );
$stmt_filter_culture->bindParam(":region", $regionName, PDO::PARAM_STR);				
$stmt_filter_culture->execute();
echo '<label class="select_label">';
echo '<select class="select id="culture_select" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" name="region">';
echo '<option value="region.php?section='.$sectionName.'&region='.$regionName.'&culture=-1&material=-1"> Culture </option>';
while ($row = $stmt_filter_culture->fetch(PDO::FETCH_ASSOC)){
	$cult2 = preg_replace("/\([^)]+\)/","",$row['cult']);
	$cult = trim($cult2);
	echo $cult.'asd';
	if($cult!=""){
		if(strcmp(strtolower($cultureName),strtolower($cult))==0){
			$selected=" selected";
		}
		else
		{
			$selected="";
		}
		echo '<option value="region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cult.'"'.$selected.'>'.$cult.'</option>';
	}
}
echo '</select>';
echo '</label>';
//
//filter for material
$stmt_filter_material = $db->prepare('(SELECT DISTINCT(substring(material,1,CASE WHEN instr(material,"(")=0 THEN CASE WHEN instr(material,"|")=0 THEN LENGTH(material) ELSE instr(material,"|")-1 END ELSE instr(material,"(")-1 END)) as mater FROM '.$sectionName.' WHERE (CASE WHEN :culture <> - 1 THEN culture LIKE concat("%",:culture,"%") ELSE 1=1 END) AND (CASE WHEN :region <> - 1 THEN provenience LIKE concat("%",:region,"%") ELSE 1=1 END) ORDER BY material)' );
$stmt_filter_material->bindParam(":region", $regionName, PDO::PARAM_STR);	
$stmt_filter_material->bindParam(":culture", $cultureName, PDO::PARAM_STR);	
$stmt_filter_material->execute();
echo '<label class="select_label">';
echo '<select class="select id="material_select" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" name="region">';
echo '<option value="region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material=-1"> Material </option>';
while ($row = $stmt_filter_material->fetch(PDO::FETCH_ASSOC)){
	$mater = preg_replace("/\([^)]+\)/","",$row['mater']);
	if($mater!=""){
		if(strcmp(strtolower($materialName),strtolower($mater))==0){
			$selected=" selected";
		}
		else
		{
			$selected="";
		}
		echo '<option value="region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$mater.'"'.$selected.'>'.$mater.'</option>';
	}
}
echo '</select>';
echo '</label>';
//
//filter for date made
echo '<label class="select_label">';
echo '<select class="select "id="date_select" onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value);" name="region">';
echo '<option value="region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$materialName.'&early=-1&late=-1"> Date made </option>';
for ($i=2000;$i>=100;$i=$i-100){
	$j=$i-100;
	if(strcmp(strtolower($dateEarly),strtolower($j))==0){
		$selected=" selected";
	}
	else{
		$selected="";
	}
	echo '<option value="region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$materialName.'&early='.$j.'&late='.$i.'"'.$selected.'>'.$i.'-'.$j.'</option>';
}
if($dateEarly==-1&&$dateLate==0){
	$selected=" selected";
}
else{
	$selected="";
}
echo '<option value="region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$materialName.'&early=-1&late=0"'.$selected.'>B.C.</option>';
echo '</select>';
echo '</label>';
//
echo '</div>';
?>