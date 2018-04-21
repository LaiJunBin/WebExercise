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
    	<header>電子報製作精靈</header>
        <a class="fill" href="index.php">回電子報</a>
        <a class="fill" href="addLayout.php">新增版型</a>
        <form method="post" action="addProcess.php" enctype="multipart/form-data">
            <table>
            	<tr>
                    <td>選擇版型</td>
                    <td>
                       <?php
					   		include_once('../db.php');
					   		$sql ='select * from layout';
							$query = $db->query($sql);
							$isFirst = true;
							while($res = $query->fetch(PDO::FETCH_ASSOC)){?>
								<button type="button" class="demoLayoutBtn" va="<?php echo $res['l_id'];?>"><?php echo $res['l_title'];?></button>
                                <input type="radio" name="layout" <?php if($isFirst) { $isFirst=false; ?> checked <?php } ?> value="<?php echo $res['l_id'];?>"/>選擇
							<?php }
					   ?>
                       <div id="demoLayoutDialog" class="news">
                       		<header>標題</header>
                            <main>內文...</main>
                            <link rel="stylesheet" id="newLink">
                       </div>
                    </td>
                </tr>
                <tr>
                    <td>標題</td>
                    <td><input type="text" name="title" required/></td>
                </tr>
                <tr>
                    <td>類別</td>
                    <td><input type="text" name="category" required/></td>
                </tr>
                <tr>
                    <td>內容</td>
                    <td>
                       <textarea class="input" style="height:200px;" name="content" required/></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        圖片
                    </td>
                    <td>
                    	<input type="file" name="img" class="ui-button"/>
                    </td>
                </tr>
                <tr>
                    <td>相關連結</td>
                    <td>
                       <input type="text" name="link" required/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">新增</button>
                    <button type="reset">重設</button></td>
                </tr>
            </table>
           </form>
    </div>
</body>
</html>