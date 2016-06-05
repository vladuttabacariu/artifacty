<!DOCTYPE html5>
<html>
	<?php include '../includes/header.php'; ?>
	<body>   
		<?php include '../includes/navigationBar.php'; ?>
		<div id="container">
				<?php
				//vars
				$no_data = 1;
				$regionName;
				$sectionName;
				$cultureName;
				$materialName;
				$dateEarly;
				$dateLate;
				//
				//vars initialiaze
				if(isset($_GET['region'])){$regionName = $_GET['region'];}else{$regionName = -1;}
				if(isset($_GET['section'])&&$_GET['section']!=-1){$sectionName = $_GET['section'];}
				else{
					$stmt_get_section = $db->prepare('SELECT curatorial_section FROM get_section WHERE provenience LIKE concat("%",:region,"%")');
					$stmt_get_section->bindParam(":region", $regionName, PDO::PARAM_STR);
					$stmt_get_section->execute();
					$row = $stmt_get_section->fetch(PDO::FETCH_ASSOC);
					if(count($row['curatorial_section'])>0){$sectionName = str_Replace(" ","_",$row['curatorial_section']);}else{$no_data=0;}
				}
				if(isset($_GET['culture'])){$cultureName=$_GET['culture'];}else{$cultureName=-1;}
				if(isset($_GET['material'])){$materialName=$_GET['material'];}else{$materialName=-1;}
				if(isset($_GET['early'])){$dateEarly=$_GET['early'];}else{$dateEarly=-1;}
				if(isset($_GET['late'])){$dateLate=$_GET['late'];}else {$dateLate=-1;}
				//
				//echo $materialName.'<br>';
				//echo $regionName.'<br>';
				//display info
				$stmt_get_info = $db->prepare('SELECT info FROM section_info WHERE section LIKE concat("%",:section,"%")');
				$stmt_get_info->bindParam(":section", $sectionName, PDO::PARAM_STR);
				$stmt_get_info->execute();
				$row = $stmt_get_info->fetch(PDO::FETCH_ASSOC);
				echo '<div class="sectionInfo">'.$row['info'].'</div>';
				//
				// display artifacts				
				if($no_data>0){
					//vars
					$images_path = '../data_images';
					$search_dir;
					$images;
					$img;
					$itemsPerPage=25;				
					//
					//get number of records
					$stmt_count = $db->prepare('SELECT count(distinct(object_name)) as numberOfRecords FROM '.$sectionName.' WHERE (CASE WHEN :late <> -1 then CAST(date_made_late as INT) <= :late ELSE 1=1 END) AND (CASE WHEN :early <> -1 then CAST(date_made_early as INT) > :early ELSE 1=1 END) AND (CASE WHEN :material <> -1 then material LIKE concat("%",:material,"%") ELSE 1=1 END) AND (CASE WHEN :culture <> -1 then culture LIKE concat("%",:culture,"%") ELSE 1=1 END) AND (CASE WHEN :region <> -1 then provenience LIKE concat("%",:region,"%") ELSE 1=1 END)' );
					$stmt_count->bindParam(":region", $regionName, PDO::PARAM_STR);
					$stmt_count->bindParam(":culture", $cultureName, PDO::PARAM_STR);
					$stmt_count->bindParam(":material", $materialName, PDO::PARAM_STR);
					$stmt_count->bindParam(":early", $dateEarly, PDO::PARAM_INT);
					$stmt_count->bindParam(":late", $dateLate, PDO::PARAM_INT);
					$stmt_count->execute();
					$row = $stmt_count->fetch(PDO::FETCH_ASSOC);					
					//echo '<br>'.$row['numberOfRecords'].'<br>';
					$numberOfRecords = $row['numberOfRecords'];
					$last_page = ceil($row['numberOfRecords']/$itemsPerPage);
					//echo $last_page;
					//
					// include filters and pagination pages
					include '../includes/filters.php';
					include '../includes/pagination.php';
					//	
					// get and display artifacts	
					$offset=$itemsPerPage*($page-1);												
					$stmt = $db->prepare('SELECT distinct(object_name), curatorial_section, object_number, culture, provenience, material, emuIRN  FROM '.$sectionName.' WHERE (CASE WHEN :late <> -1 then CAST(date_made_late as INT) <= :late ELSE 1=1 END) AND (CASE WHEN :early <> -1 then CAST(date_made_early as INT) > :early ELSE 1=1 END) AND (CASE WHEN :material <> -1 then material LIKE concat("%",:material,"%") ELSE 1=1 END) AND (CASE WHEN :culture <> -1 then culture LIKE concat("%",:culture,"%") ELSE 1=1 END) AND (CASE WHEN :region <> -1 then provenience LIKE concat("%",:region,"%") ELSE 1=1 END) GROUP BY object_name LIMIT 25 OFFSET :startat');
					$stmt->bindParam(":region", $regionName, PDO::PARAM_STR);
					$stmt->bindParam(":culture", $cultureName, PDO::PARAM_STR);
					$stmt->bindParam(":material", $materialName, PDO::PARAM_STR);
					$stmt->bindParam(":early", $dateEarly, PDO::PARAM_INT);
					$stmt->bindParam(":late", $dateLate, PDO::PARAM_INT);
					$stmt->bindParam(':startat', $offset, PDO::PARAM_INT);
					$stmt->execute();
					echo '<ul id="regionTable">';
					while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$csection = str_Replace(" ","_",$row['curatorial_section']);
						$search_dir = $images_path.'/'.$csection.'/'.$row['emuIRN'].'/';
						$images = glob($search_dir.'*.jpg');
						if(count($images)>0){
							$img = $images[0];
						}
						else{
							
						}
						echo '<li class="item">';
						echo '<div class="artifacts_container"><a href="object.php?section='.$sectionName.'&id='.$row['emuIRN'].'"><img class="artifacts_img" src='.$img.' /><div class="spans"><span class="artifacts name">'.$row['object_name'].'</a></span><span class="artifacts number">'.$row['object_number'].'</span>';
						//echo '<div>';
						//if( $user->is_logged_in()) { echo '<span class="addRemoveArtifacts"><a href="javascript:addToMyArtifacts('.$row['emuIRN'].')">Add to my artifacts</a></span>';}
						//echo '</div>';
						echo '</li>';
					}
					echo '</ul>';
					include '../includes/pagination.php';
					//
				}
				else{
					echo '<span class="noData">Sorry no data</span>';
				}
				?>				
		</div>
	</body>
	<?php include '../includes/footer.php'; ?>
</html>