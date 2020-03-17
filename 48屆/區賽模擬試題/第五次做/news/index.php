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
			location.href="./index.php";
		});
		$("#categoryView").click(function(){
			location.href="./category.php";
		});
		
		$("#news").dialog({
			autoOpen:false,
			width:1000,
			height:700,	
		});
		$(".modifyLayoutBtn").click(function(){
			var id = $(this).attr('va')
			var layout = $(this).data('layout');
			location.href=`modify.php?id=${id}&layout=${layout}`;
		});
		$(".deleteBtn").click(function(){
			var id = $(this).attr('va')
			location.href=`delete.php?id=${id}`;
		});
		$(".viewNewsBtn").click(function(){
			var id = $(this).attr('va');
			var layout = $(this).data('layout');
			var btn = $(this);
			$("#newsLink").attr('href','css.php?id='+layout);
			$.ajax({
				url:'count.php',
				method:"POST",
				data:{
					id:id,
					count:parseInt(btn.parent().prev().text())+1
				},
				success:function(res){
					btn.parent().prev().text(res);
				}
			});
			$.ajax({
				url:'news.php?id='+ id,
				dataType:'json',
				success:function(res){
					$("#newsImage").hide();
					$("#newsLinkDiv").css('margin-top','0');
					if(res.n_img!=''){
						$("#newsImage").show();
						$("#newsImage").attr('src',res.n_img);	
						
					}
					$("#news>header").text(res.n_title);
					$("#news main xmp").text(res.n_note);
					$("#newsLinkDiv").html("<hr> 相關連結："+res.n_link);
					$("#news").dialog('open');
					if(parseInt($("#news main xmp").height())<280){
						$("#newsLinkDiv").css('margin-top','280px');
					}
					
				}
			});
			
		});
	});
	
	
</script>
</head>

<body>

	<div class="container">
    	<header>電子報</header>

        	<a class="fill" href="../">回首頁</a>
            <a class="fill" href="add.php">電子報製作精靈</a>
            
            <form method="post" action="">
            	<input type="text" name="keyword" />
                <br />
  
                <button type="submit" name="type" value="n_title">標題查詢</button>
                <button type="submit" name="type" value="n_note">全文查詢</button>
                <button type="button" id="clearSearchBtn">取消查詢</button>
                <button type="button" id="categoryView">類別統計</button>
            </form>
			<table align="center">
                <tr>
                    <th>類別</th>
                    <th>標題</th>
                    <th>點閱次數</th>
                    <th>操作</th>
                </tr>
                <?php
					include_once('../db.php');
					
					$pattern = '';
					if(isset($_POST['keyword'])){
						
						$keys = array_keys($_POST);
						foreach($keys as $key){
							$$key = $_POST[$key];	
						}
						$pattern .= " where {$type} like '%{$keyword}%'";
					}
					$sql = 'select * from news'.$pattern;
					
					$query = $db->query($sql);
					while($res = $query->fetch(PDO::FETCH_ASSOC)){
				?>
                <tr>
                    <td><?php echo $res['n_category'];?></td>
                    <td><?php echo $res['n_title'];?></td>
                    <td><?php echo $res['n_count'];?></td>
                    <td class="btnSet">
                    	<button type="button" class="viewNewsBtn" va="<?php echo $res['n_id'];?>" data-layout="<?php echo $res['n_layout'];?>">查看</button>
                        <button type="button" class="modifyLayoutBtn" va="<?php echo $res['n_id'];?>" data-layout="<?php echo $res['n_layout'];?>">修改</button>
                        <button type="button" class="deleteBtn" va="<?php echo $res['n_id'];?>">刪除</button>
                    </td>
                    
                </tr>
                <?php } ?>
            </table>
            <div id="news" title="電子報">
                <header>標題</header>
                <div>
                    <img id="newsImage" width="300" height="300" style="float:left;"/>
                    <main><xmp>內文...</xmp></main>
                </div>
               
                <div id="newsLinkDiv">
                
                </div>
            </div>
            <link id="newsLink" rel="stylesheet"  />
        
    </div>

</body>
</html>