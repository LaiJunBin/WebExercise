<?php
	include_once('../db.php');
	
	$sql = 'select l_number from login order by l_number desc limit 1';
	$query = $db->query($sql);
	$result = $query->fetch(PDO::FETCH_ASSOC);
	$id = str_pad($result['l_number']+1,3,0,STR_PAD_LEFT);
	
	
	$sql = 'insert into login(l_number,l_name,l_username,l_password,l_type) values(:number,:name,:username,:password,:type)';
	$query = $db->prepare($sql);
	$query->bindValue('number',$id);
	$query->bindValue('name',$_POST['name']);
	$query->bindValue('username',$_POST['username']);
	$query->bindValue('password',$_POST['password']);
	$query->bindValue('type',$_POST['type']);
	$query->execute();
	
	
	
	header('location:../index.php?member');
	
?>