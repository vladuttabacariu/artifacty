<?php
include('../includes/config.php');
$username = $_GET['username'];
$id = $_GET['id'];
echo $username;
echo $id;
$stmt = $db->prepare('DELETE FROM  myartifacts WHERE username = :username and emuIRN= :emuIRN');
$stmt->execute(array(
':username' => $username,
':emuIRN' => $id
));
?>