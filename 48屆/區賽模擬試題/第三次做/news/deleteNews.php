<?php
	include_once('../db.php');
	$sql = 'delete from news where n_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(':id',$_GET['id']);
	$query->execute();
	header('location:index.php');
?>