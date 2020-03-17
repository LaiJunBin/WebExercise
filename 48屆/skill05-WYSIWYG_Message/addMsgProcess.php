<?php
	include_once('db.php');
	$sql = 'insert into msg(m_title,m_content) values(:title,:content)';
	$query = $db->prepare($sql);
	$query->bindValue(':title',$_POST['title']);
	$query->bindValue(':content',$_POST['content']);
	$query->execute();
	
?>