<?php
	include_once('../db.php');

	$keys = array_keys($_POST);
		foreach($keys as $key){
			$$key = $_POST[$key];	
		}
	
	$sql = 'update news set n_layout = :layout where n_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(":id",$id);
	$query->bindValue(":layout",$layout);
	$query->execute();
	$res = $query->fetch(PDO::FETCH_ASSOC);
	header('location:index.php');
?>