<?php
	include_once('../db.php');

	$id = $_GET['id'];
	
	$sql = 'delete from user where u_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(":id",$id);
	$query->execute();
	header('location:manager.php');
?>