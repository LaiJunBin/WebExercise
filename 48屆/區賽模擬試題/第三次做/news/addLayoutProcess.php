<?php
	include_once('../db.php');
	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}
	var_dump($_POST);
	$save_css = '';
	if($_FILES['img']['name']!=''){
		$fileName = date('YmdHis').$_FILES['img']['name'];
		move_uploaded_file($_FILES['img']['tmp_name'],'background/'.$fileName);
		$save_css = '.news{background:url("background/'.$fileName.'") !important;background-size: 100% 100% !important;}';
		
	}
	$save_css .= $css;
	
	$sql = 'insert into layout (l_css,l_title) values(:css,:title)';
	$query = $db->prepare($sql);
	$query->bindValue(":css",$save_css);
	$query->bindValue(":title",$title);
	$query->execute();
	header('location:add.php');
?>