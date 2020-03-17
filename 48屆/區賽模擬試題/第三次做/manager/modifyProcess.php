<?php
	include_once('../db.php');
	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}
	var_dump($_POST);
	$sql = 'update user set u_name=:name,u_username=:user,u_password=:pwd,u_type=:type where u_id=:id';
	$query = $db->prepare($sql);
	$query->bindValue(":name",$name);
	$query->bindValue(":user",$user);
	$query->bindValue(":pwd",$pwd);
	$query->bindValue(":type",$type);
	$query->bindValue(":id",$id);
	$query->execute();
	header('location:index.php');
?>