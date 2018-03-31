<?php

	$file = '';
	$text = '';
	$css = '';
	if(!empty($_FILES['background']['name'])){
		$file = date("YmdHis").$_FILES['background']['name'];
		move_uploaded_file($_FILES['background']['tmp_name'],'background/'.$file);
		$css = '.news{background-size:100% 100%;background:url("'.'background/'.$file.'");}';
	}
	$css .= '.newsTitle{font-size:'.$_POST['titleSize'].'px;color:'.$_POST['titleColor'].';}';
	$css .= '.newSContent{font-size:'.$_POST['contentSize'].'px;color:'.$_POST['contentColor'].';}';
	
	
	$text .= "標題文字大小:".$_POST['titleSize']."px<br>"."標題文字顏色:".$_POST['titleColor']."<br>";
	$text .= "內容文字大小:".$_POST['contentSize']."px<br>"."內容文字顏色:".$_POST['contentColor']."<br>";
	$text .= "背景圖片:<img width=300px src=".'news/background/'.$file." alt=無背景圖片>";
	
	include_once('../db.php');
	
	
	
	$sql = 'insert into layout(l_title,l_css,l_text) values(:title,:css,:text)';
	$query = $db->prepare($sql);
	$query->bindValue(':title',$_POST['title']);
	$query->bindValue(':css',$css);
	$query->bindValue(':text',$text);
	$query->execute();
	header('location:../index.php?news');
?>