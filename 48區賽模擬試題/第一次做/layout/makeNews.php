<h1>電子報製作精靈</h1>
<?php
	include_once('db.php');
	$sql = 'select * from layout';
	$query = $db->query($sql);
	$first = true;	
?>
選擇版型:<a class="ui-button" href="?makeLayout">製作版型</a>
<form action="news/add.php" method="post" enctype="multipart/form-data">
<table width="50%" border="0" align="center">
  


<?php 
	while($row = $query->fetch(PDO::FETCH_ASSOC)){ ?>
    	
    <tr>
        <td><button type="button" class="ui-button layoutBtn" va="<?php echo $row['l_id'];?>"><?php echo $row['l_title'];?></button></td>
        <td><input <?php if($first){ $first=false;?> checked <?php } ?> type="radio" name="layout" value="<?php echo $row['l_id'];?>" style="width:20px;height:20px;">選擇</td>
    </tr>
  
       
       
       <div title="<?php echo $row['l_title'];?>" style="display:none;" class="dialogDiv" id="layoutMore<?php echo $row['l_id'];?>">
 	<?php echo $row['l_text'];?><br>
    檢視CSS:
    <?php echo $row['l_css'];?>      
       </div>
        
        
   <?php }
?>

<tr>
	<td>
    	輸入標題
    </td>
    <td>
    	<input required type="text" name="title">
    </td>
</tr>
<tr>
	<td>
    	輸入內文
    </td>
    <td>
    	<textarea required style="height:100px;width:100%;" name="content"></textarea>
    </td>
</tr>
<tr>
	<td>
    	上傳圖片
    </td>
    <td>
    	<input class="ui-button" type="file" name="img">
    </td>
</tr>
<tr>
	<td>
    	相關連結
    </td>
    <td>
    	<input type="text" name="link">
    </td>
</tr>
<tr>
	<td colspan="2">
   		<button class="ui-button"  type="submit">建立電子報</button>
    </td>
</tr>
</table>


</form>
<script>
	$(function(){
		$(".dialogDiv").dialog({
			autoOpen:false	
		});
		$(".layoutBtn").click(function(){
			var va = $(this).attr("va");
			$("#layoutMore"+va).dialog('open');
		});
	});
</script>