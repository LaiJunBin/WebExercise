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
		$("#news").dialog({
			autoOpen:false,
			width:1000,
			height:700,	
		});
		$(".viewLayoutBtn").click(function(){
			var id = $(this).attr('va');
			$("#newsLink").attr('href','css.php?id='+id);
			$("#news").dialog('open');
		});
	});
</script>
<?php
	$id = $_GET['id'];
	$layout = $_GET['layout'];
	
?>
</head>

<body>

	<div class="container">
    	<header>修改版型</header>
        
        <a class="fill" href="index.php">回電子報</a>
        <form method="post" action="modifyProcess.php" enctype="multipart/form-data">
            <table align="center">
                <tr>
                    <th colspan = "2">修改版型</th>
                </tr>
                <tr>
                    <td>選擇版型</td>
                    <td>
                    	<?php
							include_once('../db.php');
							$sql = 'select * from layout';
							$query = $db->query($sql);
							while($res = $query->fetch(PDO::FETCH_ASSOC)){
						?>
                        	<button type="button" class="viewLayoutBtn" va="<?php echo $res['l_id'];?>"><?php echo $res['l_title'];?></button>
                            <input type="radio" name="layout" value="<?php echo $res['l_id'];?>" <?php if($res['l_id']==$layout){ ?> checked <?php } ?> />選擇
                        <?php } ?>
                        <div id="news" title="電子報">
                        	<header>標題</header>
                            <main>內文...</main>
                        </div>
                        <link id="newsLink" rel="stylesheet"  />
                    </td>
                </tr>
                <tr>
                    <td><button type="submit">修改</button></td>
                    <td><button type="reset">重設</button></td>
                </tr>
            </table>
			<input type="hidden" name="id" value="<?php echo $id;?>" />
        </form>
    </div>

</body>
</html>