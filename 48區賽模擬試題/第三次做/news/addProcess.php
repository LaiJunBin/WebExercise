<?php
	include_once('../db.php');
	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}
	
	var_dump($_POST);
	$img = '';
	if($_FILES['img']['name']!=''){
		$fileName = date('YmdHis').$_FILES['img']['name'];
		$img = 'image/'.$fileName;
		move_uploaded_file($_FILES['img']['tmp_name'],$img);
	}
	
	$sql = 'insert into news (n_title,n_category,n_content,n_layout,n_img) values(:title,:category,:content,:layout,:img)';
	$query = $db->prepare($sql);
	$query->bindValue(":title",$title);
	$query->bindValue(":category",$category);
	$query->bindValue(":content",$content);
	$query->bindValue(":layout",$layout);
	$query->bindValue(":img",$img);
	$query->execute();
	header('location:index.php');
?>