<h1>修改版型</h1>
<?php
	include_once('db.php');
	$sql = 'select * from layout';
	$query = $db->query($sql);
?>
<form action="news/modifyLayout.php?id=<?php echo $_GET['id'];?>" method="post" enctype="multipart/form-data">
<table align="center">
<?php 
	while($row = $query->fetch(PDO::FETCH_ASSOC)){ ?>
    	
    <tr>
        <td><button type="button" class="ui-button layoutBtn" va="<?php echo $row['l_id'];?>"><?php echo $row['l_title'];?></button></td>
        <td><input <?php if($row['l_id']==$_GET['layout']){?> checked <?php } ?>  type="radio" name="layout" value="<?php echo $row['l_id'];?>" style="width:20px;height:20px;">選擇</td>
    </tr>
  
       
       
       <div title="<?php echo $row['l_title'];?>" style="display:none;" class="dialogDiv" id="layoutMore<?php echo $row['l_id'];?>">
 	<?php echo $row['l_text'];?><br>
    檢視CSS:
    <?php echo $row['l_css'];?>      
       </div>
        
        
   <?php }
?>
<tr>
	<td colspan="2">
   		<button class="ui-button"  type="submit">修改版型</button>
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