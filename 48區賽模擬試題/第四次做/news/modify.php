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
		$("#demoLayoutDialog").dialog({
			autoOpen:false,
			width:500,
			height:500,
		});
		$(".demoLayoutBtn").click(function(){
			$("#demoLayoutDialog").dialog('option','title',$(this).text());
			$("#demoLayoutDialog").dialog('open');
			$("#newLink").attr('href','getCss.php?id='+$(this).attr('va'));
		});
	});
</script>

</head>


<body>
	<div class="container">
    	<header>修改版型</header>
        <a class="fill" href="index.php">回電子報</a>
        <form method="post" action="modifyProcess.php">
        選擇版型
<br />
                       <?php
					   		$id = $_GET['id'];
					   		include_once('../db.php');
					   		$sql ='select * from layout';
							$query = $db->query($sql);
							
							while($res = $query->fetch(PDO::FETCH_ASSOC)){?>
								<button type="button" class="demoLayoutBtn" va="<?php echo $res['l_id'];?>"><?php echo $res['l_title'];?></button>
                                <input type="radio" name="layout" <?php if($res['l_id'] == $_GET['layout']) {?> checked <?php } ?> value="<?php echo $res['l_id'];?>"/>選擇
							<?php }
					   ?>
                       <div id="demoLayoutDialog" class="news">
                       		<header>標題</header>
                            <main>內文...</main>
                            <link rel="stylesheet" id="newLink">
                       </div>
<hr />
            <button type="submit">修改</button>
            <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
           </form>
    </div>
</body>
</html>