<?php
	include_once('../db.php');
	$sql = 'delete from login where l_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue('id',$_GET['id']);
	$query->execute();
	header('location:../index.php?member');
?>