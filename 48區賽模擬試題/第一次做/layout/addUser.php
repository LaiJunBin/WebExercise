<h1>汽車共乘 - 會員新增</h1>

<form action="user/add.php" method="post">
	<table id="loginTable" width="50%" border="0" align="center">
      <tr>
    <td>請輸入姓名:</td>
    <td><input type="text" required name="name" placeholder="請輸入姓名"></td>
  </tr>
  <tr>
    <td>請輸入帳號:</td>
    <td><input type="text" required name="username" placeholder="請輸入帳號"></td>
  </tr>
  <tr>
    <td> 請輸入密碼:</td>
    <td><input type="text" required name="password" placeholder="請輸入密碼"></td>
  </tr>
  <tr>
    <td>權限</td>
    <td>
    	<input type="radio" checked style="width:20px;height:20px" name="type" value="一般使用者" />一般使用者
        <input type="radio" style="width:20px;height:20px" name="type" value="管理員" />管理員
    
    </td>
  </tr>

  <tr>
  	<td colspan="2">
    	<button class="ui-button" type="submit">新增</button>
    </td>
  </tr>
</table>

	
   
    
    
</form>