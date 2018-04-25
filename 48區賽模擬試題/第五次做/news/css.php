<?php
	header('content-type:text/css');
	include_once('../db.php');
	
	$id = $_GET['id'];
	
	$sql = 'select * from layout where l_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(":id",$id);
	$query->execute();
	$res = $query->fetch(PDO::FETCH_ASSOC);
	
	echo $res['l_css'];
	
?>