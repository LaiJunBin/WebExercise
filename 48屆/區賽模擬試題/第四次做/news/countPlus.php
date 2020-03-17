<?php
	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}

	include_once('../db.php');
	$sql ='update news set n_count = :count where n_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(':count',$count);
	$query->bindValue(':id',$id);
	$query->execute();

	
?>