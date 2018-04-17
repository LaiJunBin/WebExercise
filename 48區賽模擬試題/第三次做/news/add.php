<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>無標題文件</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="../assets/main.js"></script>
<link rel="stylesheet" href="../assets/main.css">

<script>
	$(function(){
		$(".news").dialog({
			autoOpen:false,
			width:500,
			height:500
		});
		$(".layoutBtn").click(function(){
			var va = $(this).attr('va');
			$(".news[va="+va+']').dialog('open');
			$("#newStyle").attr('href','layout.php?id='+va);
		});
	});
</script>

</head>

<body>
	<div id="container">
    	<header>電子報製作精靈</header>
    	<main>
        	<a class="fill" href="index.php">回電子報</a>
            <a class="fill" href="addLayout.php">製作新版型</a>
            <form method="POST" action="addProcess.php" enctype="multipart/form-data">
                <table align="center">
                	<tr>
                        <td>
                            選擇版型
                        </td>
                        <td>
                            <?php
								include_once('../db.php');
								$sql = 'select * from layout';
								$query = $db->query($sql);
								$isFirst = true;
								while($result = $query->fetch(PDO::FETCH_ASSOC)){?>
									選擇<input type="radio" name="layout" value="<?php echo $result['l_id'];?>" <?php if($isFirst){ $isFirst=false;?> checked <?php } ?>/>
                                    <button type="button" class="layoutBtn" va="<?php echo $result['l_id'];?>"><?php echo $result['l_title'];?></button>
                                    
                                    <div title="標題" class="news" va="<?php echo $result['l_id'];?>" style="display:none;">
                                        <main>內文...</main>
                                    </div>
								<?php }
							?>
                            <link rel="stylesheet" id="newStyle">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            標題
                        </td>
                        <td>
                            <input type="text" name="title" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            類別
                        </td>
                        <td>
                            <input type="text" name="category" required />
                        </td>
                    </tr>
                 	<tr>
                        <td>
                            內文
                        </td>
                        <td>
                            <textarea name="content" required style="height:200px;"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            圖片
                        </td>
                        <td>
                            <input class="ui-button" style="width:85%;" type="file" name="img" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            相關連結
                        </td>
                        <td>
                            <input type="text" name="link" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit">新增</button>
                        </td>
                        <td>
                            <button type="reset">重設</button>
                        </td>
                    </tr>
                </table>
            </form>
            
        </main>
    </div>
</body>
</html>
