<?php
	include_once('../db.php');
	$sql = 'update news set n_count = :count where n_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(':count',$_GET['count']);
	$query->bindValue(':id',$_GET['id']);
	$query->execute();
?>