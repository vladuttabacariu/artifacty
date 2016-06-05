<!DOCTYPE html5>
<html>
	<?php include '../includes/header.php'; ?>
	<body>   
		<?php include '../includes/navigationBar.php'; ?>
		<div id="container">
			<div class="filters_label">Search results:</div>
				<?php
				function clean($string) {
					$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

					return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
				}
				$searchTerm = $_GET['search'];
				$searchTerms = explode("-",clean($searchTerm));
				$x = count($searchTerms);
				$images_path = '../data_images';
				$search_dir;
				$images;
				$img;
				echo '<ul id="regionTable">';
				for ($i=0;$i<count($searchTerms);$i++){
					//echo $searchTerms[$i].'<br>';
					$stmt = $db->prepare('SELECT distinct(col),emu,cur,objno FROM (SELECT distinct(object_name) as col,emuIRN as emu,object_number as objno,curatorial_section as cur FROM artifacts WHERE object_name LIKE concat("%",:term,"%")) as G2 JOIN artifacts as G1   ON G1.object_name = G2.col group by col');
					$stmt->bindParam(":term", $searchTerms[$i], PDO::PARAM_STR);
					$stmt->execute();
					$row = $stmt->fetch(PDO::FETCH_ASSOC);
					if(count($row['col'])>0){
						while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
							$csection = str_Replace(" ","_",$row['cur']);
							$search_dir = $images_path.'/'.$csection.'/'.$row['emu'].'/';
							$images = glob($search_dir.'*.jpg');
							if(count($images)>0){
								$img = $images[0];
							}
							else{
								
							}
							echo '<li class="item">';
							echo '<div class="artifacts_container"><a href="object.php?section='.$row['cur'].'&id='.$row['emu'].'"><img class="artifacts_img" src='.$img.' /><div class="spans"><span class="artifacts name">'.$row['col'].'</a></span><span class="artifacts number">'.$row['objno'].'</span><div></div>';
							echo '</li>';
						}
					}
					else{					
						$stmt2 = $db->prepare('SELECT emuIRN,object_name,object_number,curatorial_section,ROUND ((LENGTH(description)- LENGTH( REPLACE ( description, :term, ""))) / LENGTH(:term)) as col  FROM artifacts WHERE ROUND ((LENGTH(description)- LENGTH( REPLACE ( description, :term, ""))) / LENGTH(:term)) group by col desc');
						$stmt2->bindParam(":term", $searchTerms[$i], PDO::PARAM_STR);
						$stmt2->execute();
						$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
						if(count($row2['emuIRN'])>0){
							while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
								
								$csection = str_Replace(" ","_",$row2['curatorial_section']);
								$search_dir = $images_path.'/'.$csection.'/'.$row2['emuIRN'].'/';
								
								$images = glob($search_dir.'*.jpg');
								if(count($images)>0){
									$img = $images[0];
								}
								else{
									
								}
								echo '<li class="item">';
								echo '<div class="artifacts_container"><a href="object.php?section='.$csection.'&id='.$row2['emuIRN'].'"><img class="artifacts_img" src='.$img.' /><div class="spans"><span class="artifacts name">'.$row2['object_name'].'</a></span><span class="artifacts number">'.$row2['object_number'].'</span><div></div>';
								echo '</li>';
							}
						}
						else{
							echo '<div class="filters_label">Sorry! No results found.</div>';
						}
					}
				}
				echo '</ul>';
				?>
				
		</div>
	</body>
	<?php include '../includes/footer.php'; ?>
</html>