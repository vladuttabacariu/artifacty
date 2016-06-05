<?php
include('../includes/config.php');
$username = $_GET['username'];
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=data.csv');
// create a file pointer connected to the output stream
$output = fopen('php://output', 'w');
// output the column headings
fputcsv($output, array('curatorial_section','object_number','object_name','culture','native_name','culture','provenience','material','period','date_made','date_made_early','date_made_late','accession_credit_line','creator','description','manufacture_locationlocus','culture_area','technique','iconography','measurement_height','measurement_length','measurement_width','measurement_outside_diameter','measurement_tickness','measurement_unit'));
$stmt = $db->prepare('SELECT curatorial_section,object_number,object_name,culture,native_name,culture,provenience,material,period,date_made,date_made_early,date_made_late,accession_credit_line,creator,description,manufacture_locationlocus,culture_area,technique,iconography,measurement_height,measurement_length,measurement_width,measurement_outside_diameter,measurement_tickness,measurement_unit  FROM  (SELECT emuIRN from myartifacts where username = :username) as G1 JOIN artifacts as G2 ON G1.emuIRN = G2.emuIRN');
$stmt->bindParam(":username", $username, PDO::PARAM_STR);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) fputcsv($output, $row);
echo $output;
?>