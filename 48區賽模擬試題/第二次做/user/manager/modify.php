<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改使用者</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../../css/main.css">
<?php
	session_start();
	include_once("../../db.php");
	$sql = 'select * from user where u_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(':id',$_GET['id']);
	$query->execute();
	$row = $query->fetch(PDO::FETCH_ASSOC);
?>


</head>

<body>
	<div id="container">
    	<header修改使用者</header>
		<a class="ui-button fill" href="index.php">回管理者專區</a>
        <form method="post" action="modifyProcess.php">
            <table width="50%" border="0" align="center" style="line-height:30px;">
            	<tr>
                <td>姓名</td>
                <td><input type="text" required name="name" value="<?php echo $row['u_name'];?>"/></td>
              </tr>
              <tr>
                <td>帳號</td>
                <td><input type="text" required name="username" value="<?php echo $row['u_username'];?>" /></td>
              </tr>
              <tr>
                <td>密碼</td>
                <td><input type="password" required name="password" value="<?php echo $row['u_password'];?>" /></td>
              </tr>
          <tr>
                <td>權限</td>
                <td>
                	<input type="radio" name="type" value="一般使用者" <?php if($row['u_type']=='一般使用者'){?> checked <?php } ?> />一般使用者
                    <input type="radio" name="type" value="管理者" <?php if($row['u_type']=='管理者'){?> checked <?php } ?>/>管理者
                </td>
              </tr>
                <td><button class="ui-button" type="submit">修改</button></td>
                <td><button class="ui-button" type="reset">重設</button></td>
              </tr>
            </table>
            <input type="hidden" name="id" value="<?php echo $row['u_id'];?>" />
		</form>
    </div>

</body>
</html>