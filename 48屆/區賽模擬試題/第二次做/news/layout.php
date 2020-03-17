<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>製作版型</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../css/main.css">
<?php
	session_start();
	include_once("../db.php");
?>
<body>
	<div id="container">
    	<header>製作版型</header>
         <a class="ui-button fill" href="add.php">回電子報製作精靈</a>
        <form method="post" action="layoutProcess.php" enctype="multipart/form-data">
            <table width="50%" border="0" align="center" style="line-height:30px;">
              <tr>
                <td>版型名稱</td>
                <td><input type="text" required name="title" /></td>
              </tr>
              <tr>
                <td>版型背景</td>
                <td><input type="file" name="img" class="ui-button"/></td>
              </tr>
              <tr>
                <td>標題大小(px)</td>
                <td><input type="text" required name="ts"/></td>
              </tr>
              <tr>
                <td>標題色彩</td>
                <td><input type="color" required name="tc" class="fill"/></td>
              </tr>
              <tr>
                <td>內文大小(px)</td>
                <td><input type="text" required name="cs"/></td>
              </tr>
              <tr>
                <td>內文色彩</td>
                <td><input type="color" required name="cc" class="fill"/></td>
              </tr>
              <tr>
                <td><button class="ui-button" type="submit">新增版型</button></td>
                <td><button class="ui-button" type="reset">重設</button></td>
              </tr>
            </table>
		</form>
    </div>

</body>
</html>