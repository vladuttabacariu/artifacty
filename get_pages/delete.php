<?php
include('../includes/config.php');

echo $_GET['item'];
$stmt = $db->prepare('DELETE FROM '.$_GET['table'].' WHERE emuIRN = :emuIRN');
$stmt->bindParam(":emuIRN", $_GET['item'], PDO::PARAM_INT);
$stmt->execute();
?>