<h1>版型製作</h1>
<form action="news/layout.php" method="post" enctype="multipart/form-data">
	<table width="50%" border="0" align="center" style="line-height:50px;">
    <tr>
    <td>版型名稱</td>
    <td><input type="text" required name="title" placeholder="輸入版型名稱"></td>
  </tr>  
  <tr>
    <td>標題大小(px)</td>
    <td><input type="number" required name="titleSize" placeholder="輸入標題大小"></td>
  </tr>
  <tr>
    <td>標題色彩</td>
    <td><input type="color" required name="titleColor" placeholder="輸入標題色彩"></td>
  </tr>
    <tr>
    <td>內文大小(px)</td>
    <td><input type="number" required name="contentSize" placeholder="輸入內文大小"></td>
  </tr>
    <tr>
    <td>內文色彩</td>
    <td><input type="color" required name="contentColor" placeholder="輸入內文色彩"></td>
  </tr>
    <tr>
    <td>背景圖片</td>
    <td>
    	<input type="file" class="ui-button " name="background">
    </td>
  </tr>
  <tr>
  	<td colspan="2">
    	<button class="ui-button" type="submit">新增版型</button>
    </td>
  </tr>
</table>

</form>