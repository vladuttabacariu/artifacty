<!DOCTYPE html5>
<html>
	<?php include '../includes/header.php'; ?>
	<body>   
		<?php include '../includes/navigationBar.php'; ?>
		<div id="container">
		    <div class="label">Select table:</div>
			<div class="buttons">
			<button id="asian" class="button table" type="button" onclick="loadTable(this.id)">African</button>
			<button id="american" class="button table" type="button" onclick="loadTable(this.id)">American</button>
			<button id="asian" class="button table" type="button" onclick="loadTable(this.id)">Asian</button>
			<button id="egyptian" class="button table" type="button" onclick="loadTable(this.id)">Egyptian</button>
			<button id="european" class="button table" type="button" onclick="loadTable(this.id)">European</button>
			<button id="mediterranean" class="button table" type="button" onclick="loadTable(this.id)">Mediterranean</button>
			<button id="near_eastern" class="button table" type="button" onclick="loadTable(this.id)">Near Eastern</button>
			<button id="oceanian2" class="button table" type="button" onclick="loadTable(this.id)">Oceanian</button>
			</div>
			<?php
			if(isset($_GET['table'])){
				$stmt = $db->prepare('SELECT object_name,curatorial_section,emuIRN,provenience,culture,material,description FROM '.$_GET['table'].' ORDER BY object_name');
				$stmt->execute();
				$row = $stmt->fetch(PDO::FETCH_ASSOC);
				echo '<div id="selectItemContainer">';
				echo '<select id="selectItem" size="20" >';
				echo '<option disabled>emuIRN - Object Name - Provenience</option>';
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo '<option value="'.$row['emuIRN'].'">'.$row['emuIRN'].' - '.$row['object_name'].' - '.$row['provenience'].'</option>';
				}
				echo '</select>';
				echo '</div>';
				echo '<div class="buttons">';
				echo '<button id="insert" class="button table" type="button" onclick="updateinsert()">Insert</button>';
				echo '<button id="update" class="button table" type="button" onclick="getItem(\''.$_GET['table'].'\')">Update</button>';
				echo '<button id="delete" class="button table" type="button" onclick="deleteFromTable(\''.$_GET['table'].'\')">Delete</button>';
				echo '</div>';
			}
			?>
			<div id="updateinsert" style="display:none;">
			<input placeholder="emuIRN"></input>
			<input placeholder="Curatorial section"></input>
			<input placeholder="Object name"></input>		
			<input placeholder="Provenience"></input>
			<input placeholder="Culture"></input>
			<input placeholder="Material"></input>
			<input placeholder="Description"></input>
			<button id="ok" class="button table" type="button" onclick="update()">Ok</button>
			</div>
		</div>
		<script type="text/javascript" src="<?php echo $siteroot;?>/javascript/admin.js"></script>
	</body>
	<?php include '../includes/footer.php'; ?>
</html>