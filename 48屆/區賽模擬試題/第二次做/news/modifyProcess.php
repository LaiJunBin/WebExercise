<?php
	include_once('../db.php');
	$sql = "update news set n_layout = :layout where n_id = :id";
	
	$query = $db->prepare($sql);
	$query->bindValue(":layout",$_POST['layout']);
	$query->bindValue(":id",$_POST['id']);
	$query->execute();
	header('location:index.php');
?>