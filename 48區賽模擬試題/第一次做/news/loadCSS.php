<?php
	header('content-type:text/css');
	
	include_once('../db.php');
	
	$id = $_GET['id'];
	
	$sql = 'select l_css from layout where l_id = :id';
	$query = $db->prepare($sql);
	$query->bindvalue('id',$id);
	$query->execute();
	
	$result = $query->fetch(PDO::FETCH_ASSOC);

	echo $result['l_css'];
	
?>