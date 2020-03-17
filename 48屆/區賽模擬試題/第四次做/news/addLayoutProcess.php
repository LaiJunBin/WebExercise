<?php
	include_once('../db.php');
	session_start();
	
	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}
	
	if($_FILES['img']['tmp_name'] != ''){
		$fileName = date("YmdHis").$_FILES['img']['name'];
		move_uploaded_file($_FILES['img']['tmp_name'],'background/'.$fileName);
		$css .= '.news{background:url("background/'.$fileName.'") !important;background-size: 100% 100% !important;}';
	}
	
	$sql = 'insert into layout(l_title,l_css) values(:title,:css)';
	$query = $db->prepare($sql);
	$query->bindValue(':title',$title);
	$query->bindValue(':css',$css);
	$query->execute();
	$res = $query->fetch(PDO::FETCH_ASSOC);
	
	header('location:add.php');
?>