<?php
	session_start();
	date_default_timezone_set("Asia/Taipei");
	include_once('../db.php');
	$sql = 'update user set u_logout = :logout where u_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(':logout',date('Y-m-d H:i:s'));
	$query->bindValue(':id',$_SESSION['login_id']);
	$query->execute();
	unset($_SESSION['login']);
	unset($_SESSION['login_id']);
	header('location:../index.php');
?>