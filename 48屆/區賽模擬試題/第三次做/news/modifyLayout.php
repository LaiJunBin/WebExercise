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
    	<header>修改電子報版型</header>
    	<main>
        	<a class="fill" href="index.php">回電子報</a>
           <?php
				include_once('../db.php');
				$id = $_GET['id'];
				$sql = 'select * from news where n_id = :id';
				$query = $db->prepare($sql);
				$query->bindValue(':id',$id);
				$query->execute();
				$result = $query->fetch(PDO::FETCH_ASSOC);
				$layout = $result['n_layout'];
				
				$sql = 'select * from layout';
				$query = $db->prepare($sql);
				$query->bindValue(':id',$id);
				$query->execute();
				?>
				<form method="POST" action="modifyLayoutProcess.php">
				<?php 
				while($result = $query->fetch(PDO::FETCH_ASSOC)){ ?>
					選擇<input type="radio" name="layout" value="<?php echo $result['l_id'];?>" <?php if($result['l_id'] == $layout){ $isFirst=false;?> checked <?php } ?>/>
					<button type="button" class="layoutBtn" va="<?php echo $result['l_id'];?>"><?php echo $result['l_title'];?></button>
					<div title="標題" class="news" va="<?php echo $result['l_id'];?>" style="display:none;">
                    	<header>標題</header>
                        <main>內文...</main>
                    </div>
            	<?php }
				
				 
				
			?>
            <link rel="stylesheet" id="newStyle">
            <br />
				<button type="submit" name="id" value="<?php echo $id;?>">修改</button>
			</form>
        </main>
    </div>
</body>
</html>

