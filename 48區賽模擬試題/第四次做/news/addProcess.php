<?php
	include_once('../db.php');
	session_start();
	
	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}
	$img = '';
	if($_FILES['img']['tmp_name'] != ''){
		$fileName = date("YmdHis").$_FILES['img']['name'];
		$img = 'image/'.$fileName;
		move_uploaded_file($_FILES['img']['tmp_name'],'image/'.$fileName);
	}
	
	$sql = 'insert into news(n_title,n_category,n_content,n_layout,n_link,n_img) values(:title,:category,:content,:layout,:link,:img)';
	$query = $db->prepare($sql);
	$query->bindValue(':title',$title);
	$query->bindValue(':category',$category);
	$query->bindValue(':content',$content);
	$query->bindValue(':layout',$layout);
	$query->bindValue(':link',$link);
	$query->bindValue(':img',$img);
	$query->execute();
	
	
	header('location:index.php');
?>