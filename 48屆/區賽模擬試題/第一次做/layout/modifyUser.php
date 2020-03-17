<h1>汽車共乘 - 會員修改</h1>
<?php
	include_once('db.php');
	
	$sql = 'select * from login where l_id = :id';
	$query = $db->prepare($sql);
	$query->bindValue('id',$_GET['id']);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
?>
<form action="user/modify.php?id=<?php echo $result['l_id'];?>" method="post">
	<table id="loginTable" width="50%" border="0" align="center">
      <tr>
    <td>請輸入姓名:</td>
    <td><input type="text" required name="name" placeholder="請輸入姓名" value="<?php echo $result['l_name'];?>"></td>
  </tr>
  <tr>
    <td>請輸入帳號:</td>
    <td><input type="text" required name="username" placeholder="請輸入帳號" value="<?php echo $result['l_username'];?>"></td>
  </tr>
  <tr>
    <td> 請輸入密碼:</td>
    <td><input type="text" required name="password" placeholder="請輸入密碼" value="<?php echo $result['l_password'];?>"></td>
  </tr>
  <tr>
    <td>權限</td>
    <td>
    	<input type="radio" <?php if($result['l_type']=='一般使用者'){ ?> checked <?php } ?> style="width:20px;height:20px" name="type" value="一般使用者" />一般使用者
        <input type="radio" <?php if($result['l_type']=='管理員'){ ?> checked <?php } ?>  style="width:20px;height:20px" name="type" value="管理員" />管理員
    
    </td>
  </tr>

  <tr>
  	<td colspan="2">
    	<button class="ui-button" type="submit">修改</button>
    </td>
  </tr>
</table>

	
   
    
    
</form>