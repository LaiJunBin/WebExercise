<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>汽車共乘網站</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="css/main.css">
<?php
	session_start();
	include_once("db.php");
?>


</head>

<body>
	<div id="container">
    	<header>汽車共乘網站</header>

       	<?php
			if(isset($_SESSION['login'])){
				echo '您為:'.$_SESSION['login'];
		?>
        	<a class="ui-button fill" href="user/logout.php">登出</a>
            <?php
				if($_SESSION['login']=='管理者'){
			?>
            	<a class="ui-button fill" href="user/manager/index.php">管理者專區</a>
            <?php }else{ ?>
            	<a class="ui-button fill" href="user/user.php">一般會員專區</a>
            
            <?php } ?>
        <?php }else{ ?>
        	<a class="ui-button fill" href="user/login.php">登入</a>
        
        
        <?php } ?>
        <a class="ui-button fill" href="news/index.php">瀏覽電子報</a>
        
    </div>

</body>
</html>