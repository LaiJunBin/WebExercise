<?php
	include_once('../../db.php');
	$sql = "insert into user(u_username,u_password,u_name,u_type) values(:user,:pwd,:name,:type)";
	
	$query = $db->prepare($sql);
	$query->bindValue(":user",$_POST['username']);
	$query->bindValue(":pwd",$_POST['password']);
	$query->bindValue(":name",$_POST['name']);
	$query->bindValue(":type",$_POST['type']);
	$query->execute();
	header('location:index.php');
?>