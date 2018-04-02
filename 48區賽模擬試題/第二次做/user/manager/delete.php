<?php
	include_once("../../db.php");
	
	$sql = 'delete from user where u_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(":id",$_GET['id']);
	$query->execute();
	header('location:index.php');
?>