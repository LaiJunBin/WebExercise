<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../assets/main.css">
<script src="../assets/main.js"></script>
<script>
	$(function(){
		
	});
</script>
<?php
	include_once('../db.php');
	$sql = 'select *from user where u_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue(':id',$_GET['id']);
	$query->execute();
	$res = $query->fetch(PDO::FETCH_ASSOC);
?>
</head>


<body>
	<div class="container">
    	<header>修改使用者</header>
        <a class="fill" href="index.php">回管理者專區</a>
        <form method="post" action="modifyProcess.php">
            <table>
                <tr>
                    <td>帳號</td>
                    <td><input type="text" name="user" value="<?php echo $res['u_username'];?>" required/></td>
                </tr>
                <tr>
                    <td>密碼</td>
                    <td><input type="password" name="pwd" value="<?php echo $res['u_password'];?>"  required/></td>
                </tr>
                <tr>
                    <td>姓名</td>
                    <td>
                       <input type="text" name="name" value="<?php echo $res['u_name'];?>"  required/>
                    </td>
                </tr>
                <tr>
                    <td>
                        權限
                    </td>
                    <td>
                    	<input type="radio" name="type" <?php if($res['u_type'] == '一般使用者') {?> checked <?php } ?>  value="一般使用者">一般使用者
                        <input type="radio" name="type" <?php if($res['u_type'] == '管理者') {?> checked <?php } ?>   value="管理者">管理者
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">修改</button>
                    <button type="reset">重設</button></td>
                </tr>
            </table>
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
           </form>
    </div>
</body>
</html>