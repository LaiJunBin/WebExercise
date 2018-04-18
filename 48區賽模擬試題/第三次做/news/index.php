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
		$(".viewNewsBtn").click(function(){
			var va = $(this).attr('va');
			$.ajax({
				url:'getNews.php?id='+va,
				dataType:'JSON',
				success:function(res){
					$(".news>header").text(res.title);	
					$(".news>main").text(res.main);
					$("#newsLink").text("相關連結："+res.link);
					$("#newsImg").html('')
					$("#newStyle").attr('href','layout.php?id='+res.layout);
					if(res.img!=undefined){
						var image = document.createElement('img');
						image.src = res.img;
						$("#newsImg").html(image)
							
					}
					$(".news").dialog('open');
					$(".news").css('display','inline-flex');
					
				}
			})
			var count = parseInt($(this).parent().next().text());
			count +=1;
			$.ajax({
				url:'newCountPlus.php',
				method:'get',
				async:false,
				data:{
					id:va,
					count:count
				}
			});
			$(this).parent().next().text(count);
		});
		$(".switchLayoutBtn").click(function(){
			var va = $(this).attr('va');
			location.href="modifyLayout.php?id="+va;
		});
		$(".deleteNewsBtn").click(function(){
			var va = $(this).attr('va');
			location.href="deleteNews.php?id="+va;
		});
		$("#clearSearchBtn").click(function(){
			location.href="index.php";
		});
	});
</script>

</head>

<body>
	<div id="container">
    	<header>電子報</header>
        <a class="fill" href="../index.php">回首頁</a><br />
    	<a class="fill" href="add.php">電子報製作精靈</a><br />
        <a class="fill" href="category.php">電子報類別統計</a><br />
        <form action="#" method="POST">
        	搜尋:<input type="text" name="keyword" />
			<button type="submit" name="query" value="n_title">標題查詢</button>
            <button type="submit" name="query" value="n_content">全文查詢</button>
            <button type="button" id="clearSearchBtn">取消查詢</button>
        </form>
        <table align="center">
        <tr>
        	<th>類別</th>
            <th>標題</th>
            <th>操作</th>
            <th>點閱次數</th>
        </tr>
		<?php
			include_once("../db.php");
			session_start();
			$pattern = '';
			if(isset($_POST['keyword'])){
				$pattern = ' where '.$_POST['query'].' like "%'.$_POST['keyword'].'%"';
			}
			
			$sql = 'select * from news'.$pattern;

			$query = $db->query($sql);
			
			while($result = $query->fetch(PDO::FETCH_ASSOC)){
		?>
        	<tr>
            	<td><?php echo str_pad($result['n_category'],3,0,STR_PAD_LEFT);?></td>
              	<td><?php echo $result['n_title'];?></td>
                <td>
                	<button type="button" class="ui-button viewNewsBtn" va="<?php echo $result['n_id'];?>">查看</button>
                    
                    <?php if(isset($_SESSION['login']) && $_SESSION['login']=='管理者'){ ?>
                        <button type="button" class="ui-button switchLayoutBtn" va="<?php echo $result['n_id'];?>">切換版型</button>
                        <button type="button" class="ui-button deleteNewsBtn" va="<?php echo $result['n_id'];?>">刪除</button>
                    <?php } ?>
                </td>
                <td><?php echo $result['n_count'];?></td>
                
            </tr>
        <?php } ?>
        </table>
        <div class="news" title="電子報瀏覽" style="display:none;flex-flow: wrap;">	
        	<header></header>
            <main></main>
            <div id="newsImg"></div>
            <div id="newsLink"></div>
        </div>
        <link rel="stylesheet" id="newStyle">
    </div>
</body>
</html>
