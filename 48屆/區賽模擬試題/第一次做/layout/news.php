<h1>汽車共乘 - 電子報</h1>
<a class="ui-button fill" href="?makeNews">電子報製作精靈</a>
<link id="loadCSS" href="news/loadCss.php?id=1" rel="stylesheet" type="text/css">
<?php
	include_once('db.php');
	$sql = 'select * from news';
	$query = $db->query($sql);
	while($row = $query->fetch(PDO::FETCH_ASSOC)){
		?>
        <button cs="<?php echo $row['n_layout'];?>" class="newsBtn ui-button fill" va="<?php echo $row['n_id'];?>"><?php echo $row['n_title'];?></button>

               <div title="<?php echo $row['n_title'];?>" style="display:none;" class="dialogDiv" id="newsMore<?php echo $row['n_id'];?>">
     <div class="news" style="height:500px;">
     <?php if($_SESSION['login_type'] == '管理員'){?>
	 	<a class="ui-button" href="?modifyLayout&id=<?php echo $row['n_id'];?>&layout=<?php echo $row['n_layout'];?>">修改版型</a>
<?php } 	 ?>
    	<div class="newsTitle">
        	標題:<?php echo $row['n_title'];?>
        </div>  
 	  	<div class="newSContent">
        	內容:<?php echo $row['n_content'];?>
        </div>
        <?php if(!empty($row['n_img'])){
			echo '<img width="500px" src="news/img/'.$row['n_img'].'"><br>';	
		}?>
        <?php echo "相關連結".$row['n_link'];?>
       </div>
        </div>
    <?php }
	
?>


<script>
	$(function(){
		$(".dialogDiv").dialog({
			autoOpen:false	,
			width:'70%',
			height:'500',
		});
		$(".newsBtn").click(function(){
			var va = $(this).attr("va");
			var cs = $(this).attr('cs');
			$("#newsMore"+va).dialog('open');
			$("#loadCSS").attr('href','news/loadCSS.php?id='+cs);
		});
	});
</script>