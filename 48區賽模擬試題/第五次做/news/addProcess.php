<?php
	include_once('../db.php');

	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}
	$img = '';
	if($_FILES['img']['tmp_name'] !=''){
		$base = 'images/';
		$fileName = date('YmdHis').$_FILES['img']['name'];
		move_uploaded_file($_FILES['img']['tmp_name'],$base.$fileName);
		$img = $base.$fileName;
	}
	
	$sql = 'insert into news(n_title,n_category,n_note,n_img,n_link,n_layout) values(:title,:category,:note,:img,:link,:layout)';

	$query = $db->prepare($sql);
	$query->bindValue(":title",$title);
	$query->bindValue(":category",$category);
	$query->bindValue(":note",$note);
	$query->bindValue(":img",$img);
	$query->bindValue(":link",$link);
	$query->bindValue(":layout",$layout);
	$query->execute();
	
	header('location:index.php');
?>