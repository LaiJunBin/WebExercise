<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>電子報</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../css/main.css">
<?php
	session_start();
	include_once("../db.php");
?>


</head>

<body>
	<div id="container">
    	<header>電子報</header>
        <a class="ui-button fill" href="../">回首頁</a>
		<a class="ui-button fill" href="add.php">電子報製作精靈</a>
        <hr /> 查詢:
        <form action="" method="post">
       		<input type="radio" name="type" checked value="n_title"/>標題查詢
            <input type="radio" name="type" value="n_content"/>全文查詢
        	<input type="text" name="key" />
            <button type="submit" class="ui-button">查詢</button>
            <a href="index.php" class="ui-button">取消查詢</a>
        </form>
        <a href="category.php" class="ui-button">統計類別</a>
        <table width="100%" border="0" align="center">
        <tr>
        	<th width="20%">類別</th>
            <th width="65%">電子報標題</th>
            <th width="15%">瀏覽次數</th>
          </tr>
          <?php
		  	$whereText = '';
		  	if(isset($_POST['key'])){
				$whereText = ' where '.$_POST['type'].' like "%'.$_POST['key'].'%"';
			}
			$sql = 'select * from news'.$whereText;
			$query = $db->query($sql);
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
			?>
            <tr>
            <td><?php echo $row['n_category'];?></td>
            <td><button type="button" class="ui-button fill newsMoreBtn" layout="<?php echo $row['n_layout'];?>" va="<?php echo $row['n_id'];?>"><?php echo $row['n_title'];?></button></td>
				<td id="newsCount<?php echo $row['n_id'];?>"><?php echo $row['n_count'];?></td>
          </tr>
               <div class="newsMore" va="<?php echo $row['n_id'];?>" style="display:none;">
               		<div class="news">
                    	<?php
							if(isset($_SESSION['login']) && $_SESSION['login']=='管理者'){
						?>
                        <a href="modify.php?id=<?php echo $row['n_id'];?>&layout=<?php echo $row['n_layout'];?>" class="ui-button">修改版型</a>
                        <?php } ?>
                    	<header><?php echo $row['n_title'];?></header>
                        <img src="<?php echo $row['n_img'];?>" width="300" height="300" alt="沒有圖片" />
                        <main>內容:<br /><?php echo $row['n_content'];?></main>
                        相關連結:<?php echo $row['n_link'];?>
                    </div>
               </div>
		<?php } ?>
            
        </table>

    	<div id="linkDiv"></div>
    </div>
<script>
	$(function(){
		$(".newsMore").dialog({
			autoOpen:false,
			width:'500px',
			height:'500',
		});
		$(".newsMoreBtn").click(function(){
			var id = $(this).attr('va');
			$(".newsMore[va="+id+']').dialog({
				title:$(this).text()
			});
			$("#linkDiv").html('<link rel="stylesheet" href="loadCss.php?id='+$(this).attr('layout')+'">');
			$(".newsMore[va="+id+']').dialog("open");
			$.ajax({
				url:'newsCountPlus.php',
				data:{
					'id':id,
					'c':$("#newsCount"+id).text()
				},
				success:function(count){
					$("#newsCount"+id).text(count);
				}
			});
		});
	});
</script>

</body>
</html>