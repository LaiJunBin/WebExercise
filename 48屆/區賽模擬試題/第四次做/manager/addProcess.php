<?php
	include_once('../db.php');

	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}
	
	$sql = 'insert into user(u_username,u_password,u_name,u_type) values(:user,:pwd,:name,:type)';
	$query = $db->prepare($sql);
	$query->bindValue(':user',$user);
	$query->bindValue(':pwd',$pwd);
	$query->bindValue(':name',$name);
	$query->bindValue(':type',$type);
	$query->execute();

	header('location:index.php');
?>