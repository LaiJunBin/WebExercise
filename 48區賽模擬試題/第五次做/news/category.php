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


</head>

<body>

	<div class="container">
    	<header>類別統計</header>

        	<a class="fill" href="./index.php">回電子報</a>
            
          
			<table align="center">
                <tr>
                    <th>類別</th>
                    <th>篇數</th>
                    <th>總點閱次數</th>
                </tr>
                <?php
					include_once('../db.php');
					
					$sql = 'select sum(n_count) as clickCount,count(n_id) as count,n_category as category from news group by n_category';
					
					$query = $db->query($sql);
					while($res = $query->fetch(PDO::FETCH_ASSOC)){
				?>
                <tr>
                    <td><?php echo $res['category'];?></td>
                    <td><?php echo $res['count'];?></td>
                    <td><?php echo $res['clickCount'];?></td>
  
                    
                </tr>
                <?php } ?>
            </table>

    </div>

</body>
</html>