<?php
	include_once('../db.php');
	$sql = 'update news set n_count = :count where n_id =:id';
	$count = $_GET['c']+=1;
	$query = $db->prepare($sql);
	$query->bindValue(':count',$count);
	$query->bindValue(':id',$_GET['id']);
	$query->execute();
	echo $count;
?>