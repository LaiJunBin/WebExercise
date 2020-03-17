<?php
	include_once("../db.php");
	$file = '';
	if(!empty($_FILES['img']['name'])){
		$file = date("YmdHis").$_FILES['img']['name'];
		move_uploaded_file($_FILES['img']['tmp_name'],'img/'.$file);
	}
	$sql = 'insert into news(n_title,n_content,n_img,n_link,n_layout) values(:title,:content,:img,:link,:layout)';
	$query = $db->prepare($sql);
	$query->bindValue(':title',$_POST['title']);
	$query->bindValue(':content',$_POST['content']);
	$query->bindValue(':img',$file);
	$query->bindValue(':link',$_POST['link']);
	$query->bindValue(':layout',$_POST['layout']);
	$query->execute();
	header('location:../index.php?news');
?>