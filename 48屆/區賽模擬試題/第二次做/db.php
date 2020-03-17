<?php
	$user = "root";
	$pwd = "";
	$dbname = 'skill';
	$host = 'localhost';
	$dsn = "mysql:host=$host;dbname=$dbname";
	$db = new PDO($dsn,$user,$pwd);
	$db->exec("set names utf8");
?>