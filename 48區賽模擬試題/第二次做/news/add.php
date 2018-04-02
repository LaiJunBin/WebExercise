<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>電子報製作精靈</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../css/main.css">
<?php
	session_start();
	include_once("../db.php");
?>

<script>
	$(function(){
		$("#news").dialog({
			autoOpen:false,
			width:'500px',
			height:'500',
		});
		$(".layoutMoreBtn").click(function(){
			var id = $(this).attr('va');
			$("#news").dialog({
				title:$(this).text()
			});
			$("#linkDiv").append('<link rel="stylesheet" href="loadCss.php?id='+id+'">');
			$("#news").dialog("open");
		});
	});
</script>
<body>
	<div id="container">
    	<header>電子報製作精靈</header>
         <a class="ui-button fill" href="index.php">回瀏覽電子報</a>
         <a class="ui-button fill" href="layout.php">製作新版型</a>
        <form method="post" action="addProcess.php" enctype="multipart/form-data">
            <table width="50%" border="0" align="center" style="line-height:30px;">
              <tr>
                <td>選擇版型</td>
                <td>
                	<?php
						$sql = 'select * from layout';
						$query = $db->query($sql);
						$first = true;
						while($row = $query->fetch(PDO::FETCH_ASSOC)){
						?>
                        	<button type="button" class="ui-button layoutMoreBtn" va="<?php echo $row['l_id'];?>"><?php echo $row['l_title'];?></button>
                            
                       <input type="radio" name="layout" value="<?php echo $row['l_id'];?>" <?php if($first==true){ ?> checked <?php $first=false; }?>/>選擇 
                        <?php } ?>
                
                </td>
              </tr>
              <tr>
                <td>標題</td>
                <td><input type="text" required name="title" /></td>
              </tr>
              <tr>
                <td>類別</td>
                <td><input type="text" required name="category" /></td>
              </tr>
              <tr>
                <td>內容</td>
                <td><textarea required name="content" style="height:100px;width:100%;"></textarea></td>
              </tr>
              <tr>
                <td>圖片</td>
                <td><input type="file" name="img" class="ui-button"/></td>
              </tr>
              <tr>
                <td>相關連結</td>
                <td><input type="text" required name="link" /></td>
              </tr>
              <tr>
                <td><button class="ui-button" type="submit">新增電子報</button></td>
                <td><button class="ui-button" type="reset">重設</button></td>
              </tr>
            </table>
		</form>
		<div title="123" id="news" style="display:none;">
        	<header>標題文字</header>
            <main>內文...</main>
            <div id="linkDiv"></div>
        </div>
    </div>

</body>
</html>