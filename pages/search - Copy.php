<!DOCTYPE html5>
<html>
	<?php include '../includes/header.php'; ?>
	<body>   
		<?php include '../includes/navigationBar.php'; ?>
		<div id="container">
				Work in progres...
				<?php
				$regionName = $_GET['region'];
				echo $regionName.'<br>';
				
				$stmt = $db->prepare('SELECT curatorial_section, object_number, object_name, culture, provenience, material, emuIRN  FROM artifacts WHERE provenience LIKE concat("%",:region,"%") LIMIT 25');
				$stmt->bindParam(":region", $regionName, PDO::PARAM_STR);
				$stmt->execute();
				echo '<table id="regionTable"><tr><td>curatorial_section</td><td>object_number</td><td>object_name</td><td>culture</td><td>provenience</td><td>material</td></tr>';
				while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
					echo '<tr>';
					echo '<td>'.$row['curatorial_section'].'</td>';
					echo '<td>'.$row['object_number'].'</td>';
					echo '<td>'.$row['object_name'].'</td>';
					echo '<td>'.$row['culture'].'</td>';
					echo '<td>'.$row['provenience'].'</td>';
					echo '<td>'.$row['material'].'</td>';
					echo '</tr>';
				}
				echo '</table>';
				?>
				
		</div>
	</body>
	<?php include '../includes/footer.php'; ?>
</html>