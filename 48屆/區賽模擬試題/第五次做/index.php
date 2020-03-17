<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="./assets/main.css">
<script src="assets/main.js"></script>

<?php
	session_start();
	function is_login($admin = null){
		
		if(isset($_SESSION['login'])){
			if($admin === null){
				return true;	
			}else if ($admin == true){
				return $_SESSION['login'] == '管理者';	
			}else if ($admin == false){
				return $_SESSION['login'] == '一般使用者';	
			}else {
				return true;	
			}
		}else{
			return false;	
		}
	}
?>

</head>

<body>

	<div class="container">
    	<header>汽車共乘網站</header>
        <?php if(!is_login()){ ?>
        	<a class="fill" href="login/">登入</a>
        <?php }
		if(is_login()){ ?>
        	<a class="fill" href="login/logout.php">登出</a>
        <?php }
		if(is_login(true)){ ?>
        	<a class="fill" href="user/manager.php">管理者專區</a>
        <?php }
		if(is_login(false)){ ?>
        	<a class="fill" href="user/">一般會員專區</a>
        <?php } ?>
        <a class="fill" href="news/">電子報</a>
    </div>

</body>
</html>