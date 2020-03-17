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
		$("#clearSearchBtn").click(function(){
			location.href="./";
		});
		$("#categoryCountBtn").click(function(){
			location.href="count.php";
		});
		
		$(".news").dialog({
			autoOpen:false,
			width:500,
			height:500,
		});
		$(".showNews").click(function(){
			var va = $(this).attr('va');
			var layout = $(this).data('layout');
			var _this = $(this).parent().next()
			var count = _this.text();
			count++;
			$.ajax({
				url:'countPlus.php',
				method:'POST',
				data:{
					id:$(this).attr('va'),
					count:count	
				},
				success:function(res){
					_this.text(count);	
				}
			});
			$.ajax({
				url:'getNews.php?id='+va,
				dataType:'JSON',
				success:function(res){
					$(".news").dialog('option','title',res.title);
					$(".news>header").text(res.title);
					$(".news>main").text(res.content);
					if(res.img!=''){
						var image = $("<img>").attr('src',res.img).css({
							float:'left',
							'max-width':'300px',
							'max-height':'300px'	
						});
						$(".news>main").prepend(image);	
					}
					$("#newsLinkDiv").text('相關連結：'+ res.link);
					$(".news").dialog('open');
					$("#newLink").attr('href','getCss.php?id='+layout);
				}
			});
			
		});
	});
</script>

</head>


<body>
	<div class="container">
    	<header>電子報</header>
        <a class="fill" href="../index.php">回首頁</a>
        <a class="fill" href="add.php">電子報製作精靈</a>
        <form action="#" method="POST">
        	<input type="radio" name="field" value="n_title" checked />標題查詢
            <input type="radio" name="field" value="n_content" />全文查詢
        	<input type="text" name="keyword" /><br />
            <div class="btnset">
                <button type="submit">查詢</button>
                <button type="button" id="clearSearchBtn">清除查詢</button>
                <button type="button" id="categoryCountBtn">統計</button>
            </div>
        </form>
            <table style="width:90%;">
            	<tr>
                	<th>類別</th>
                    <th>標題</th>
                    <th width="20%">點閱數</th>
                    <th width="20%">操作</th>
                </tr>
               <?php 
			   		include_once('../db.php');
					$pattern = '';
					$keys = array_keys($_POST);
					foreach($keys as $key){
						$$key = $_POST[$key];	
					}
					if(isset($keyword)){
						$pattern = " where {$field} like '%{$keyword}%'";
					}
					$sql = 'select * from news'.$pattern;
					$query = $db->query($sql);
					while($res = $query->fetch(PDO::FETCH_ASSOC)){ ?>
						
                        <tr>
                            <td><?php echo $res['n_category'];?></td>
                            <td>
                            	<button class="showNews" style="width:100%;" data-layout="<?php echo $res['n_layout'];?>" va="<?php echo $res['n_id'];?>"><?php echo $res['n_title'];?></button>
                            </td>
                            <td><?php echo $res['n_count'];?></td>
                            <td>
                            	<a class="ui-button" href="modify.php?id=<?php echo $res['n_id'];?>&layout=<?php echo $res['n_layout'];?>">修改版型</a>
                                <a class="ui-button" href="delete.php?id=<?php echo $res['n_id'];?>">刪除</a>
                            </td>
                        </tr>
                        
					<?php }
			   ?>
            </table>
            <div class="news">
                <header></header>
                <main style="display:unset;"></main>
                <div id="newsLinkDiv"></div>
                <link rel="stylesheet" id="newLink">
           </div>
    </div>
</body>
</html>