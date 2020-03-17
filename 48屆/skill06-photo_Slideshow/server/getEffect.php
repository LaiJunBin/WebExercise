<?php
	session_start();
	if(!isset($_SESSION['effect']))
		$_SESSION['effect'] = 1;
	echo $_SESSION['effect'];
?>