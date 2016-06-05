<?php
include('../includes/config.php');
if(isset($_GET['id']) && isset($_GET['section'])){
	$data ="";
	$id=$_GET['id'];
	$section=$_GET['section'];
	$stmt = $db->prepare('SELECT object_name,culture,provenience,creator,description FROM '.$section.' WHERE emuIRN = :id' );
	$stmt->bindParam(":id", $id, PDO::PARAM_STR);
	$stmt->execute();
	while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
		if($row['object_name']){$data.=$row['object_name'].',';}else{$data.=' ,';}
		if($row['culture']){$data.=$row['culture'].',';}else{$data.=' ,';}
		if($row['provenience']){$data.=$row['provenience'].',';}else{$data.=' ,';}
		if($row['creator']){$data.=$row['creator'].',';}else{$data.=' ,';}
		if($row['description']){$data.=$row['description'].',';}else{$data.=' ,';}		
	}
	echo $data;
}
?>