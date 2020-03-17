<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="assets/main.css">
<script src="assets/main.js"></script>

<?php 
	session_start();
	function is_login($admin=null){
		if($admin === null){
			return isset($_SESSION['login']);
		}elseif($admin === false){
			return isset($_SESSION['login']) && $_SESSION['login'] == '一般使用者';	
		}elseif($admin === true){
			return isset($_SESSION['login']) && $_SESSION['login'] == '管理者';	
		}
	}
?>

</head>


<body>
	<div class="container">
    	<header>汽車共乘網站</header>
        <?php if(is_login()){ ?>
        	您為 <?php echo $_SESSION['login']; ?>
            <a class="fill" href="login/out.php">登出</a><?php } ?>
        <?php if(!is_login()){ ?>
        	<a class="fill" href="login/index.php">登入</a>
        <?php }elseif(is_login(false)){ ?>
        	<a class="fill" href="manager/user.php">一般使用者專區</a>
        <?php }elseif(is_login(true)){ ?>
        	<a class="fill" href="manager/index.php">管理者專區</a>
        <?php } ?>
        <a class="fill" href="news/index.php">電子報</a>
    </div>
</body>
</html>