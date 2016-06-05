<!DOCTYPE html5>
<html>
	<?php include '../includes/header.php'; ?>
	<body>   
		<?php include '../includes/navigationBar.php'; ?>
		<script type="text/javascript" src="<?php echo $siteroot;?>/javascript/myArtifacts.js"></script>
		<div id="container">
				<div class="label">My ARTIFACTS!</div>
				<?php
				$images_path = '../data_images';
				$search_dir;
				$images;
				$img;
				$stmt = $db->prepare('SELECT *  FROM  (SELECT emuIRN from myartifacts where username = :username) as G1 JOIN artifacts as G2 ON G1.emuIRN = G2.emuIRN');
				$stmt->bindParam(":username", $_SESSION['username'], PDO::PARAM_STR);
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
					echo '<li id="'.$row['emuIRN'].'" class="item">';
					echo '<div class="artifacts_container"><a href="object.php?section='.$row['curatorial_section'].'&id='.$row['emuIRN'].'"><img class="artifacts_img" src='.$img.' /><div class="spans"><span class="artifacts name">'.$row['object_name'].'</a></span><span class="artifacts number">'.$row['object_number'].'</span>';
					echo '<span class="addRemoveArtifacts list"><a href="javascript:if(confirm(\'Are you sure you want to delete this item?\')){removeFromMyArtifactsList(\''.$_SESSION['username'].'\',\''.$row['emuIRN'].'\')}"><img style="max-height:15px;" src="../images/addremove/minus.png" />Remove</a></span>';
					echo '</li>';
				}
				echo '</ul>';
				?>
				<div class="label">You can download your artifacts list, along with all items information, by pressing the download button down below!</div>
				<div class="button download"><button id="download" onclick="downloadList('<?php echo $_SESSION['username']?>')" type="button">Download List</button></div>				
				<script type="text/javascript" src="<?php echo $siteroot;?>/javascript/downloadList.js"></script>
		</div>
	</body>
	<?php include '../includes/footer.php'; ?>
</html>