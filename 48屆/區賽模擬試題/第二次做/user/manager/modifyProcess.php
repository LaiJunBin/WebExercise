<?php
	include_once('../../db.php');
	$sql = "update user set u_name = :name , u_username = :username , u_password = :password ,u_type = :type where u_id = :id";
	
	$query = $db->prepare($sql);
	$query->bindValue(":name",$_POST['name']);
	$query->bindValue(":username",$_POST['username']);
	$query->bindValue(":password",$_POST['password']);
	$query->bindValue(":type",$_POST['type']);
	$query->bindValue(":id",$_POST['id']);
	$query->execute();
	header('location:index.php');
?>