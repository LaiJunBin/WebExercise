<?php
	if(!empty($_POST)){
		if(!isset($_POST['closeMethod']) && !isset($_POST['orderMethod'])){
			$_SESSION['whereMethod'] = $_POST['field'] .'="'. $_POST['method'].'"';
			header('location:index.php?member');
			exit();
		}elseif(!isset($_POST['orderMethod'])){
			unset($_SESSION['whereMethod']);	
		}
	}
?>


<h1>管理者專區</h1>
<a class="ui-button fill" href="?addUser">會員新增</a>

<hr />
<style>
	[type=radio]{
		width:20px;
		height:20px;	
	}
</style>
篩選
<form action="" method="POST">
	<input type="text" name="method" placeholder="篩選條件"/><br />
    以欄位
    <input type="radio" checked name="field" value="l_username" />帳號
    <input type="radio" name="field" value="l_name" />姓名
    <input type="radio" name="field" value="l_number" />使用者編號 &nbsp;&nbsp; 
    <button class="ui-button" type="submit">篩選</button>
    <button class="ui-button" type="submit" name="closeMethod" value="1">取消篩選</button>
</form>

<form action="" method="POST">
    <button class="ui-button" type="submit" name="orderMethod" value="asc">使用者編號遞增</button>
    <button class="ui-button" type="submit" name="orderMethod" value="desc">使用者編號遞減</button>
</form>	

<table border="1" width="70%" align="center">
<tr>
	<th>使用者編號</th>
    <th>帳號</th>
    <th>密碼</th>
    <th>姓名</th>
    <th>權限</th>
    <th>行為</th>
    <th>上次登入時間</th>
</tr>
	<?php
		include_once("db.php");
		$method= 1;
		$orderBy = ' order by l_number asc';
		if(isset($_POST['orderMethod'])){
			$orderBy = ' order by l_number '.$_POST['orderMethod'];	
		}
		if(isset($_SESSION['whereMethod'])){
			$method = $_SESSION['whereMethod'];
		}
		$sql = 'select * from login where '.$method.$orderBy;
		$query = $db->query($sql);
		while($row = $query->fetch(PDO::FETCH_ASSOC)){ ?>
			<tr>
        		<td><?php echo $row['l_number'];?></td>
            	<td><?php echo $row['l_username'];?></td>
                <td><?php echo $row['l_password'];?></td>
                <td><?php echo $row['l_name'];?></td>
                <td><?php echo $row['l_type'];?></td>
            	<td>
                <?php if($row['l_username']=='admin'){
					echo '無法操作';
				}else{ ?>
                	<a class="ui-button" href="?modifyUser&id=<?php echo $row['l_id']?>">修改</a>
                    <a class="ui-button "href="user/deleteUser.php?id=<?php echo $row['l_id']?>">刪除</a>
                    <?php } ?>
                </td>
                 <td>
            	<?php echo $row['l_login'];?>
                </td>
            </tr>
           
           
            
	<?php
    	}
	
	?>
</table>