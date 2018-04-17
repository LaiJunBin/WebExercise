<?php
	include_once('../db.php');
	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}
	$sql = 'insert into user(u_name,u_username,u_password,u_type) values(:name,:user,:pwd,:type)';
	$query = $db->prepare($sql);
	$query->bindValue(":name",$name);
	$query->bindValue(":user",$user);
	$query->bindValue(":pwd",$pwd);
	$query->bindValue(":type",$type);
	$query->execute();
	header('location:index.php');
?>