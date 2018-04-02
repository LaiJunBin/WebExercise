<?php
	include_once('../db.php');
	
	$file = '';
	if($_FILES['img']['name'] !=''){
		$file = 'img/'.date('YmdHis').$_FILES['img']['name'];
		move_uploaded_file($_FILES['img']['tmp_name'],$file);
	}
	
	
	$sql = "insert into news(n_title,n_content,n_link,n_category,n_img,n_layout) values(:title,:content,:link,:category,:img,:layout)";
	$query = $db->prepare($sql);
	$query->bindValue(":title",$_POST['title']);
	$query->bindValue(":content",$_POST['content']);
	$query->bindValue(":link",$_POST['link']);
	$query->bindValue(":category",$_POST['category']);
	$query->bindValue(":img",$file);
	$query->bindValue(":layout",$_POST['layout']);
	$query->execute();
	header('location:index.php');
	
?>