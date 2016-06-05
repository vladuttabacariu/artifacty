<?php
include('../includes/config.php');
echo $_GET['emuIRN'].','.$_GET['curatorial_section'].','.$_GET['object_name'].','.$_GET['provenience'].','.$_GET['culture'].','.$_GET['material'].','.$_GET['description'];
echo $_GET['table'];
$stmt = $db->prepare('DELETE FROM '.$_GET['table'].' WHERE emuIRN = :emuIRN');
$stmt->bindParam(":emuIRN", $_GET['emuIRN'], PDO::PARAM_INT);
$stmt->execute();

$stmt = $db->prepare('INSERT INTO '.$_GET['table'].' (emuIRN,curatorial_section,object_name,provenience,culture,material,description) VALUES (:emuIRN,:curatorial_section,:object_name,:provenience,:culture,:material,:description)');
$stmt->bindParam(":emuIRN", $_GET['emuIRN'], PDO::PARAM_INT);
$stmt->bindParam(":curatorial_section", $_GET['curatorial_section'], PDO::PARAM_STR);
$stmt->bindParam(":object_name", $_GET['object_name'], PDO::PARAM_STR);
$stmt->bindParam(":provenience", $_GET['provenience'], PDO::PARAM_STR);
$stmt->bindParam(":culture", $_GET['culture'], PDO::PARAM_STR);
$stmt->bindParam(":material", $_GET['material'], PDO::PARAM_STR);
$stmt->bindParam(":description", $_GET['description'], PDO::PARAM_STR);
$stmt->execute();
?>