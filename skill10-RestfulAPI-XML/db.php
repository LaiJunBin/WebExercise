<?php
    $user = 'root';
    $pwd = '';
    $host = 'localhost';
    $dbname = 'testRestfulAPI';

    $dsn = "mysql:host=$host;dbname=$dbname";

    $db = new PDO($dsn,$user,$pwd);
    
    $db->exec('set names utf8');
?>