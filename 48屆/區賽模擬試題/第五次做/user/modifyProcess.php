<?php
	include_once('../db.php');

	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}

	$sql = 'update user set u_user = :user ,u_pwd = :pwd , u_name=:name , u_type=:type where u_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(":user",$user);
	$query->bindValue(":pwd",$pwd);
	$query->bindValue(":name",$name);
	$query->bindValue(":type",$type);
	$query->bindValue(":id",$id);
	$query->execute();
	header('location:manager.php');
?>