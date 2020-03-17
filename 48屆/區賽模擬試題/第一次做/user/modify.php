<?php

	include_once('../db.php');
	
	$sql = 'update login set l_name = :name,l_username=:username,l_password = :password,l_type=:type where l_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(':name',$_POST['name']);
	$query->bindValue(':username',$_POST['username']);
	$query->bindValue(':password',$_POST['password']);
	$query->bindValue(':type',$_POST['type']);
	$query->bindValue(':id',$_GET['id']);
	$query->execute();
	
	header('location:../index.php?member');


?>