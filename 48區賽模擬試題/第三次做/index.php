<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="assets/main.js"></script>
<link rel="stylesheet" href="assets/main.css">
</head>

<?php
	session_start();
	function isLogin($admin=null){
		if($admin===null){
			return isset($_SESSION['login']);	
		}else{
			return isset($_SESSION['login']) && ($_SESSION['login'] == ($admin?"管理者":"一般使用者"));
		}
	}
?>
<body>
	<div id="container">
    	<header>汽車共乘網站</header>
    	<main>
        	<?php
				if(isLogin()){
			?>
        		你為:<?php echo $_SESSION['login'];?>
                <a class="fill" href="login/logout.php">登出</a>
        	<?php
				}
				if(!isLogin()){
			?>
            	<a class="fill" href="login/index.php">登入</a>
            <?php } 
				if(isLogin(true)){
			?>
            
            	<a class="fill" href="manager/index.php">管理者專區</a>
            <?php } 
				if(isLogin(false)){ 
			?>
            	<a class="fill" href="login/user.php">一般使用者專區</a>
            <?php } ?>
            	<a class="fill" href="news/index.php">電子報</a>
            
        </main>
    </div>
</body>
</html>
