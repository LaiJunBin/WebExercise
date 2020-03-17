<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增使用者</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../../css/main.css">
<?php
	session_start();
	include_once("../../db.php");
?>


</head>

<body>
	<div id="container">
    	<header>新增使用者</header>
		<a class="ui-button fill" href="index.php">回管理者專區</a>
        <form method="post" action="addProcess.php">
            <table width="50%" border="0" align="center" style="line-height:30px;">
            	<tr>
                <td>姓名</td>
                <td><input type="text" required name="name" /></td>
              </tr>
              <tr>
                <td>帳號</td>
                <td><input type="text" required name="username" /></td>
              </tr>
              <tr>
                <td>密碼</td>
                <td><input type="password" required name="password" /></td>
              </tr>
          <tr>
                <td>權限</td>
                <td>
                	<input type="radio" name="type" value="一般使用者" checked/>一般使用者
                    <input type="radio" name="type" value="管理者"/>管理者
                </td>
              </tr>
                <td><button class="ui-button" type="submit">新增</button></td>
                <td><button class="ui-button" type="reset">重設</button></td>
              </tr>
            </table>
		</form>
    </div>

</body>
</html>