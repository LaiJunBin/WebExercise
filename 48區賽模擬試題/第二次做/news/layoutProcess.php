<?php
	include_once('../db.php');
	
	$css = '';
	
	if($_FILES['img']['name'] !=''){
		$file = date('YmdHis').$_FILES['img']['name'];
		move_uploaded_file($_FILES['img']['tmp_name'],'background/'.$file);
		$css = '#news,.news{background:url("http://localhost/test/news/background/'.$file.'");background-size:100% 100%}';
	}
	$css .='#news header,.news header{font-size:'.$_POST['ts'].'px;color:'.$_POST['tc'].'}';
	$css .='#news main,.news main{font-size:'.$_POST['cs'].'px;color:'.$_POST['cc'].'}';
	
	
	$sql = "insert into layout(l_css,l_title) values(:css,:title)";
	$query = $db->prepare($sql);
	$query->bindValue(":css",$css);
	$query->bindValue(":title",$_POST['title']);
	$query->execute();
	header('location:add.php');
	
?>