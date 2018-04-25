<?php
	include_once('../db.php');

	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}
	
	$sql = 'update news set n_count = :count where n_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(":id",$id);
	$query->bindValue(":count",$count);
	
	$query->execute();

	echo $count;

?>