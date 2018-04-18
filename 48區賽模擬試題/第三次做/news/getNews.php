<?php
	$id = $_GET['id'];
	include_once('../db.php');
	$sql = 'select * from news where n_id=:id';
	$query = $db->prepare($sql);
	$query->bindValue(':id',$id);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	
	$res = [];
	if($result['n_img']!=''){
		$res['img'] = $result['n_img'];	
	}
	$res['title'] = $result['n_title'];
	$res['main'] = $result['n_content'];
	$res['link'] = $result['n_link'];
	$res['layout'] = $result['n_layout'];
	echo json_encode($res);
	
?>