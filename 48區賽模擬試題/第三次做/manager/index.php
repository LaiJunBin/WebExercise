<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="../assets/main.js"></script>
<link rel="stylesheet" href="../assets/main.css">


</head>

<body>
	<div id="container">
    	<header>管理者專區</header>
        <a class="fill" href="../index.php">回首頁</a><br />
    	<a class="fill" href="add.php">新增使用者</a><br />
        
        <form action="#" method="POST">
        	關鍵字查詢:<input type="text" name="keyword" /><br />
            以
            <input type="radio" name="category" value="u_username" checked/>帳號
            <input type="radio" name="category" value="u_name" />姓名
			<input type="radio" name="category" value="u_id" />使用者編號
            排序:
			<input type="radio" name="sort" value="asc" checked />遞增
			<input type="radio" name="sort" value="desc" />遞減
			<button type="submit">查詢</button>
            <button type="button" id="cleanBtn">取消查詢</button>
        </form>
        <script>
        	$(function(){
				$("#cleanBtn").click(function(){
					location.href="index.php";
				})
			});
        </script>
        <table align="center">
        <tr>
        	<th>使用者編號</th>
            <th>帳號</th>
            <th>密碼</th>
            <th>姓名</th>
            <th>管理者</th>
            <th>上次登入時間</th>
            <th>操作</th>
        </tr>
		<?php
			include_once("../db.php");
			
			$pattern = '';
			if(isset($_POST['keyword'])){
				if($_POST['keyword'] == ''){
					$pattern = ' order by '.$_POST['category'].' '.$_POST['sort'];
				}else
					$pattern = ' where u_username = "'.$_POST['keyword'].'" order by '.$_POST['category'].' '.$_POST['sort'];
			}
			
			$sql = 'select * from user'.$pattern;
			$query = $db->query($sql);
			
			while($result = $query->fetch(PDO::FETCH_ASSOC)){
		?>
        	<tr>
            	<td><?php echo str_pad($result['u_id'],3,0,STR_PAD_LEFT);?></td>
              	<td><?php echo $result['u_username'];?></td>
                <td><?php echo $result['u_password'];?></td>
                <td><?php echo $result['u_name'];?></td>
                <td><?php echo $result['u_type'];?></td>
                <td><?php echo $result['u_login'];?></td>
                <td>
                	<?php if($result['u_username'] != 'admin'){ ?>
                	<a class="ui-button" href="modify.php?id=<?php echo $result['u_id'];?>">修改</a>
                    <a class="ui-button" href="delete.php?id=<?php echo $result['u_id'];?>">刪除</a>
                    <?php } else
						echo "無法修改";
			?>
                </td>
            </tr>
        <?php } ?>
        </table>
    </div>
</body>
</html>
