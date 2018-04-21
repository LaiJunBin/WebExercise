<?php
	include_once('../db.php');
	
	$id = $_GET['id'];
	
	$sql = 'select * from news where n_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(':id',$id);
	$query->execute();
	$res = $query->fetch(PDO::FETCH_ASSOC);
	
	$value = [];
	$value['title'] = $res['n_title'];
	$value['content'] = $res['n_content'];
	$value['img'] = $res['n_img'];
	$value['link'] = $res['n_link'];
	
	echo json_encode($value);
?>