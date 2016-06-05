<!DOCTYPE html5>
<html>
	<?php include '../includes/header.php'; ?>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAxRlTtPHXCqRW4y_4XpqOfUknYqnI0esc"></script>
	<script type="text/javascript" src="<?php echo $siteroot;?>/javascript/googleMap.js"></script>
	<script type="text/javascript" src="<?php echo $siteroot;?>/javascript/metaData.js"></script>
	<script type="text/javascript" src="<?php echo $siteroot;?>/javascript/myArtifacts.js"></script>
	<body onload="loadMeta()">   
		<?php include '../includes/navigationBar.php'; ?>
		<div id="container">
			<?php
				$section;
				$objectId;
				IF (isset($_GET['section'])){
					$section = $_GET['section'];
				}
				IF (isset($_GET['id'])){
					$objectId = $_GET['id'];
				}
				
				$stmt = $db->prepare('SELECT emuIRN,curatorial_section,object_number,object_name,culture,native_name,culture,provenience,material,period,date_made,date_made_early,date_made_late,accession_credit_line,creator,description,manufacture_locationlocus,culture_area,technique,iconography,measurement_height,measurement_length,measurement_width,measurement_outside_diameter,measurement_tickness,measurement_unit  FROM '.$section.' WHERE emuIRN = :id');
				$stmt->bindParam(":id", $objectId, PDO::PARAM_STR);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				echo '<div id="objectContainer">';
				echo '<div id="objectImages">';
				$images_path = '../data_images';
				$img;
				$csection = str_Replace(" ","_",$row['curatorial_section']);
				$search_dir = $images_path.'/'.$csection.'/'.$row['emuIRN'].'/';
				$images = glob($search_dir.'*.jpg');
				echo '<div id="objectImageTop">';
				echo '<img class="imageTop" src="'.$images[0].'" />';
				echo '</div>';
				
				
				if( $user->is_logged_in()) {
					$stmt2 = $db->prepare('SELECT count(emuIRN) as counts FROM myartifacts WHERE emuIRN = :id');
					$stmt2->bindParam(":id", $objectId, PDO::PARAM_STR);
					$stmt2->execute();
					$row2 = $stmt2->fetch(PDO::FETCH_ASSOC);					
					if($row2['counts']==0){
						echo '<div id="addRemoveMyArtifacts"><span class="addRemoveArtifacts"><a href="javascript:addToMyArtifacts(\''.$_SESSION['username'].'\',\''.$row['emuIRN'].'\')"><img style="max-height:17px;" src="../images/addremove/plus.png" />Add to my artifacts</a></span></div>';
					}
					else{
						echo '<div id="addRemoveMyArtifacts"><span class="addRemoveArtifacts"><a href="javascript:removeFromMyArtifacts(\''.$_SESSION['username'].'\',\''.$row['emuIRN'].'\')"><img style="max-height:17px;" src="../images/addremove/minus.png" />Remove from my artifacts</a></span></div>';				
					}
				}
				
				echo '<div id="objectImageBottom"> ';
				echo '<ul id="objectImagesBottomUl">';
				for($i=1;$i<count($images);$i++){
					$split = explode("/",$images[$i]);
					$id = str_replace(".jpg","",$split[sizeof($split)-1]);
					echo '<li rel="tooltip"><img id="'.$id.'" class="imageBottom"  href="#" title="" src="'.$images[$i].'" /></li>';
				}
				echo '</ul>';
				echo '</div>';
				echo '<div class="map_label"><span style="color: #683624;line-height: 150%;    font-weight: bold;">Location of the current artifact in relation to other artifacts from the same continent, culture or curatorial section:</span></div>';
				echo '<div id="googleMap"></div>';
				echo '</div>';
				
				echo '<div id="objectInfo">';
				echo '<table id="objectInfoTable">';
				if($row['emuIRN']){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">emuIRN:</span></td><td><span class="objectInfo" id="emuIRN">'.$row['emuIRN'].'</span></td></tr>';}
				if($row['object_name']){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Object Title:</span></td><td><span class="objectInfo">'.$row['object_name'].'</span></td></tr>';}
				if($row['object_number']){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Object Number:</span></td><td><span class="objectInfo">'.$row['object_number'].'</span></td></tr>';}
				if(($row['culture'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Culture:</span></td><td><span class="objectInfo">'.$row['culture'].'</span></td></tr>';}
				if(($row['native_name'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Natie name:</span></td><td><span class="objectInfo">'.$row['native_name'].'</span></td></tr>';}
				if(($row['provenience'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Provenience:</span></td><td><span id=provenience class="objectInfo">'.$row['provenience'].'</span></td></tr>';}
				if(($row['material'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Material:</span></td><td><span class="objectInfo">'.$row['material'].'</span></td></tr>';}
				if(($row['period'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Period:</span></td><td><span class="objectInfo">'.$row['period'].'</span></td></tr>';}
				if(($row['date_made'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Date made:</span></td><td><span class="objectInfo">'.$row['date_made'].'</span></td></tr>';}
				if(($row['date_made_early'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Date made early:</span></td><td><span class="objectInfo">'.$row['date_made_early'].'</span></td></tr>';}
				if(($row['date_made_late'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Date made late</span></td><td><span class="objectInfo">'.$row['date_made_late'].'</span></td></tr>';}
				if(($row['accession_credit_line'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Accession credit line:</span></td><td><span class="objectInfo">'.$row['accession_credit_line'].'</span></td></tr>';}
				if(($row['creator'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Creator: </span></td><td><span class="objectInfo">'.$row['creator'].'</span></td></tr>';}
				if(($row['description'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Description:</span></td><td><span class="objectInfo">'.$row['description'].'</span></td></tr>';}
				if(($row['manufacture_locationlocus'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Manufacture locationlocus:</span></td><td><span class="objectInfo">'.$row['manufacture_locationlocus'].'</span></td></tr>';}
				if(($row['curatorial_section'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Curatorial:</span></td><td><span id="curatorial" class="objectInfo">'.$row['curatorial_section'].'</span></td></tr>';}
				if(($row['culture_area'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Culture area:</span></td><td><span class="objectInfo">'.$row['culture_area'].'</span></td></tr>';}
				if($row['technique']){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Technique:</span></td><td><span class="objectInfo">'.$row['technique'].'</span></td></tr>';}
				if(($row['iconography'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Iconography:</span></td><td><span class="objectInfo">'.$row['iconography'].'</span></td></tr>';}
				if(($row['measurement_height'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Measurement height:</span></td><td><span class="objectInfo">'.$row['measurement_height'].'</span></td></tr>';}
				if(($row['measurement_length'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Measurement length:</span></td><td><span class="objectInfo">'.$row['measurement_length'].'</span></td></tr>';}
				if(($row['measurement_width'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Measurement width:</span></td><td><span class="objectInfo">'.$row['measurement_width'].'</span></td></tr>';}
				if(($row['measurement_outside_diameter'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Measurement outside diameter:</span></td><td><span class="objectInfo">'.$row['measurement_outside_diameter'].'</span></td></tr>';}
				if(($row['measurement_tickness'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Measurement tickness:</span></td><td><span class="objectInfo">'.$row['measurement_tickness'].'</span></td></tr>';}
				if(($row['measurement_unit'])){echo '<tr><td class="objectInfoTypeTd"><span class="objectInfoType">Measurement unit:</span></td><td><span class="objectInfo">'.$row['measurement_unit'].'</span></td></tr>';}
				echo '</table>';
				
				
				echo '<div id="suggestions">';
				$prov = explode("|",$row['provenience']);
				$stmt = $db->prepare('SELECT distinct(object_name) as objectName,emuIRN,curatorial_section  FROM '.$section.' WHERE provenience LIKE concat("%",:provenience,"%") and emuIRN <> :emuIRN  ORDER BY rand() LIMIT 7');
				$stmt->bindParam(":provenience", $prov[0], PDO::PARAM_STR);
				$stmt->bindParam(":emuIRN", $row['emuIRN'], PDO::PARAM_STR);
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				echo '<div style="padding-top:15px;"><span style="color: #683624;line-height: 150%;    font-weight: bold;" >You may also be interested in these objects:</span></div>';
				echo '<ul id="suggestionsUl">';
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					
					$csection = str_Replace(" ","_",$row['curatorial_section']);
					$search_dir = $images_path.'/'.$csection.'/'.$row['emuIRN'].'/';
					$images = glob($search_dir.'*.jpg');
					if(count($images)>0){
							$img = $images[0];
						}
						else{
							
						}
					echo '<li><a href="object.php?section='.$section.'&id='.$row['emuIRN'].'"><div class="suggestionsDiv" style="background-image: url('.$img.')"></div><span class="suggestionsSpan">'.$row['objectName'].'</span></a></li>';
				}
				echo '</ul>';
				echo '</div>';
				echo '</div>';
				echo '</div>';
			?>				
		</div>
		<?php 
		if( $user->is_logged_in() ){
			echo '<div id="fixed"><div style="display:inline-block;padding:4px;"><a href="'.$siteroot.'/pages/myartifacts.php" ><span class="artifactsScroll">My Artifacts</span ></a></div><div id="message">Item added!</div></div>';
		}
		?>
	<script>
	
	jQuery( document ).ready(function( $ ) {
		var ul = document.getElementById("objectImagesBottomUl");
		var items = ul.getElementsByTagName("li");
		for (var i = 0; i < items.length; ++i) {
		  console.log(items[i].children[0].getAttribute('src'));
		  $('#'+items[i].children[0].id).tooltip({ content: '<img style="max-width:400px;" src="'+items[i].children[0].getAttribute('src')+'" />' });
		}
	});
	</script>
	</body>
	<?php include '../includes/footer.php'; ?>
</html>