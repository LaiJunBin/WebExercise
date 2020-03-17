<?php
	include_once('db.php');
	session_start();
	$_SESSION['effect'] = $_POST['effect'];
	header('location:index.php');
?>