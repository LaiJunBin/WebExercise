<h1>汽車共乘 - 首頁</h1>
<?php

	if(isset($_SESSION['login'])){
		echo "您為".$_SESSION['login_type'];	
	}

	if(empty($_SESSION['login'])){?>
   		<a href="?login" class="ui-button fill">登入</a>
    <?php
	}else{ ?>
		<a href="?logout" class="ui-button fill">登出</a>
	<?php }
	
	if(isset($_SESSION['login_type']) && $_SESSION['login_type'] == '管理員'){ ?>
		<a href="?member" class="ui-button fill">管理者專區</a>
	<?php }elseif(isset($_SESSION['login_type']) && $_SESSION['login_type'] == '一般使用者'){ ?>
    	<a href="?user" class="ui-button fill">一般會員專區</a>
    <?php }
	
?>


<a href="?news" class="ui-button fill">瀏覽電子報</a>
<a href="?newsQuery" class="ui-button fill">查詢及統計電子報</a>