<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>汽車共乘網站</title>
<script type="text/javascript" src="assets/jquery-ui-1.12.1/external/jquery/jquery.js"></script>
<script type="text/javascript" src="assets/jquery-ui-1.12.1/jquery-ui.min.js"></script>


<link href="assets/main.css" rel="stylesheet" type="text/css" />
<link href="assets/jquery-ui-1.12.1/jquery-ui.min.css" rel="stylesheet" type="text/css" />
</head>
<?php
	session_start();
	
?>
<body>
	<div id="container">
    	<?php
			function issetGET($str){
				return isset($_GET[$str]);
			}
			if(empty($_GET)){
				require('layout/index.php');	
			}elseif(issetGET('login')){
				require('layout/login.php');	
			}elseif(issetGET('logout')){
				unset($_SESSION['login']);
				unset($_SESSION['login_type']);
				header('location:index.php');
			}elseif(issetGET('member')){
				require('layout/member.php');
			}elseif(issetGET('addUser')){
				require('layout/addUser.php');
			}elseif(issetGET('modifyUser')){
				require('layout/modifyUser.php');
			}elseif(issetGET('user')){
				require('layout/user.php');
			}

			if(!issetGET('member')){
				unset($_SESSION['whereMethod']);	
			}
		?>
    </div>
</body>
</html>