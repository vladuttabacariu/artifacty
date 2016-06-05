<?php
$page;
if(isset($_GET['page'])){
	$page = $_GET['page'];
}
else
{
	$page=1;
}
$regionName = $_GET['region'];
$from=($page-1)*25;
$to=($page-1)*25+25;

echo '<div class="pagination_container">';
if ($numberOfRecords<26){
	echo '<div style="display:inline-block;width:40%;text-align:left;margin:10px;color:#814A1C;font-size:20px;">'.$numberOfRecords.' Objects</div>';
}
else{
	echo '<div style="display:inline-block;width:40%;text-align:left;margin:10px;color:#814A1C;font-size:20px;">'.$from.' - '.$to.' of '.$numberOfRecords.' Objects</div>';
}
echo '<div style="display:inline-block;width:50%;text-align:left;margin:10px;color:#814A1C;font-size:20px;">';
if ($last_page>1 && $last_page<8)
{
		for($i=1; $i<=$last_page; $i++){
			if($page==$i){
				echo '<span class="pagination active"><a href="../pages/region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$materialName.'&early='.$dateEarly.'&late='.$dateLate.'&page='.$i.'">'.$i.'</a></span>';
			}
			else{
				echo '<span class="pagination"><a href="../pages/region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$materialName.'&early='.$dateEarly.'&late='.$dateLate.'&page='.$i.'">'.$i.'</a></span>';
			}
		}
	
}
if($last_page>7){
	if($page==1){
		echo '<span class="pagination active"><a href="../pages/region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$materialName.'&early='.$dateEarly.'&late='.$dateLate.'&page=1">1</a></span>';
	}
	else{
		echo '<span class="pagination"><a href="../pages/region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$materialName.'&early='.$dateEarly.'&late='.$dateLate.'&page=1">1</a></span>';

	}
		$j=0;
	$k=2;
	if($page<5)
	{
		$j=2;		
	}
	else
	{
		if($page>$last_page-3){
			$j=$page-2;
			$k=$last_page-1-$page;
		}
		else{
			$j=$page-2;
		}
		echo ' ... ';
	}
	for($i=$j; $i<=$page+$k; $i++){
		if($page==$i){
			echo '<span class="pagination active"><a href="../pages/region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$materialName.'&early='.$dateEarly.'&late='.$dateLate.'&page='.$i.'">'.$i.'</a></span>';
		}
		else{
			echo '<span class="pagination"><a href="../pages/region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$materialName.'&early='.$dateEarly.'&late='.$dateLate.'&page='.$i.'">'.$i.'</a></span>';
		}
	}
	
	if($page>0 && $page<$last_page-3)
	{
		echo ' ... ';
	}
	if($page==$last_page){
		echo '<span class="pagination active"><a href="../pages/region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$materialName.'&early='.$dateEarly.'&late='.$dateLate.'&page='.$last_page.'">'.$last_page.'</a></span>';
	}
	else{
		echo '<span class="pagination"><a href="../pages/region.php?section='.$sectionName.'&region='.$regionName.'&culture='.$cultureName.'&material='.$materialName.'&early='.$dateEarly.'&late='.$dateLate.'&page='.$last_page.'">'.$last_page.'</a></span>';
	}
}
echo '</div>';
echo '</div>';
?>