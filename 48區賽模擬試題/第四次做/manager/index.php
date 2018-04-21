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
		$("#clearSearchBtn").click(function(){
			location.href="./";
		});
	});
</script>

</head>


<body>
	<div class="container">
    	<header>管理員專區</header>
        <a class="fill" href="../index.php">回首頁</a>
        <a class="fill" href="add.php">新增使用者</a>
        <form action="#" method="POST">
        	關鍵字查詢：
        	<input type="text" name="keyword" />
            以
            <input type="radio" name="sort" value="u_username" checked />帳號
            <input type="radio" name="sort" value="u_name" />姓名
            <input type="radio" name="sort" value="u_id" />使用者編號
            <input type="radio" name="method" value="asc" checked />遞增
            <input type="radio" name="method" value="desc" />遞減
            <button type="submit">查詢</button>
            <button type="button" id="clearSearchBtn">清除查詢</button>
        </form>
            <table style="width:90%;">
            	<tr>
                	<th>使用者編號</th>
                    <th>帳號</th>
                    <th>密碼</th>
                    <th>姓名</th>
                    <th>權限</th>
                    <th>上次登入時間</th>
                    <th>最後登出時間</th>
                    <th>操作</th>
                </tr>
               <?php 
			   		include_once('../db.php');
					$pattern = '';
					$keys = array_keys($_POST);
					foreach($keys as $key){
						$$key = $_POST[$key];	
					}
					if(isset($keyword)){
						if($keyword !=''){
							$pattern = " where u_username = '{$keyword}' order by {$sort} {$method}";
						}else{
							$pattern = " order by {$sort} {$method}";
						}
					}
					$sql = 'select * from user'.$pattern;
					$query = $db->query($sql);
					while($res = $query->fetch(PDO::FETCH_ASSOC)){ ?>
						
                        <tr>
                        	<td><?php echo str_pad($res['u_id'],3,0,STR_PAD_LEFT);?></td>
                            <td><?php echo $res['u_username'];?></td>
                            <td><?php echo $res['u_password'];?></td>
                            <td><?php echo $res['u_name'];?></td>
                            <td><?php echo $res['u_type'];?></td>
                            <td><?php echo $res['u_login'];?></td>
                            <td><?php echo $res['u_logout'];?></td>
                            <td>
                            <?php if($res['u_username'] == 'admin'){ ?>
                            	無法修改 <?php }else{ ?>
                            	<a class="ui-button" href="modify.php?id=<?php echo $res['u_id'];?>">修改</a>
                                <a class="ui-button" href="delete.php?id=<?php echo $res['u_id'];?>">刪除</a>
                               <?php } ?>
                            </td>
                        </tr>
                        
					<?php }
			   ?>
            </table>
    </div>
</body>
</html>