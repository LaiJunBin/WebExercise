<?php
	include_once('../db.php');
	
	$id = $_GET['id'];
	
	$sql = 'select * from news where n_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(":id",$id);
	$query->execute();
	$res = $query->fetch(PDO::FETCH_ASSOC);
	
	echo json_encode($res);
	
?>