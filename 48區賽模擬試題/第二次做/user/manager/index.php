<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理者專區</title>

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
    	<header>管理者專區</header>
        <a class="ui-button fill" href="../../">回首頁</a>
		<a class="ui-button fill" href="add.php">新增使用者</a><hr>
        關鍵字查詢:
        <form action="" method="post">
        	<input type="text" name="key" />
            排序:
            <input type="radio" name="sort" checked value="u_id"/>使用者編號
            <input type="radio" name="sort" value="u_name"/>姓名
            <input type="radio" name="sort" value="u_username"/>帳號
            <input type="radio" name="sortMethod" checked value="asc"/>遞增
            <input type="radio" name="sortMethod" value="desc"/>遞減
            <button type="submit" class="ui-button">查詢</button>
            <a href="index.php" class="ui-button">取消查詢</a>
        </form>
        <table width="80%" border="0" align="center">
         <tr>
            <th>使用者編號</th>
            <th>姓名</th>
            <th>帳號</th>
            <th>密碼</th>
            <th>權限</th>
            <th>上次登入時間</th>
            <th>操作</th>
          </tr>
          <?php
		  	$whereText = '';
			$orderByText = '';
			if(isset($_POST['sort'])){
				if($_POST['key']!=''){
					$whereText = 'where u_username = "'.$_POST['key'].'" ';	
				}
				$orderByText = 'order by '.$_POST['sort'].' '.$_POST['sortMethod'];
			}
		  	$sql = 'select * from user '.$whereText.$orderByText;
			$query = $db->query($sql);
			while($row = $query->fetch(PDO::FETCH_ASSOC)){ ?>
          <tr>
            <td>
            	<?php
					echo str_pad($row['u_id'],3,'0',STR_PAD_LEFT);
				?>
            </td>
            <td><?php echo $row['u_name'];?></td>
            <td><?php echo $row['u_username'];?></td>
            <td><?php echo $row['u_password'];?></td>
            <td><?php echo $row['u_type'];?></td>
            <td><?php echo $row['u_login'];?></td>
            <td>
            <?php if($row['u_name'] =='admin'){
				echo "無法操作";	
			}else{ ?>
				<a href="modify.php?id=<?php echo $row['u_id'];?>" class="ui-button">修改</a>
                <a href="delete.php?id=<?php echo $row['u_id'];?>" class="ui-button">刪除</a>
			<?php } ?>
            </td>
          </tr>
          <?php }?>
        </table>

    </div>

</body>
</html>