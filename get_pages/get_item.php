<?php
include('../includes/config.php');

$stmt = $db->prepare('SELECT * FROM '.$_GET['table'].' WHERE emuIRN = :emuIRN');
$stmt->bindParam(":emuIRN", $_GET['item'], PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
echo $row['emuIRN'].'$&*'.$row['curatorial_section'].'$&*'.$row['object_name'].'$&*'.$row['provenience'].'$&*'.$row['culture'].'$&*'.$row['material'].'$&*'.$row['description'];
?>