<?php
	include_once('../db.php');

	$id = $_GET['id'];
	
	$sql = 'delete from news where n_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(":id",$id);
	$query->execute();
	header('location:index.php');
?>