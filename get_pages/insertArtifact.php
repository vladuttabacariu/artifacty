<?php
include('../includes/config.php');
$username = $_GET['username'];
$id = $_GET['id'];
echo $username;
echo $id;
$stmt = $db->prepare('INSERT INTO myartifacts (username,emuIRN) VALUES (:username, :emuIRN)');
$stmt->execute(array(
':username' => $username,
':emuIRN' => $id
));
?>