<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>電子報</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../css/main.css">
<?php
	session_start();
	include_once("../db.php");
?>


</head>

<body>
	<div id="container">
    	<header>電子報類別統計</header>
        <a class="ui-button fill" href="index.php">回瀏覽電子報</a>
        <table width="80%" border="0" align="center">
        <tr>
        	<th width="65%">類別</th>
            <th width="15%">篇數</th>
          </tr>
          <?php
			$sql = 'select n_category,count(n_title) as c from news group by n_category order by c desc';
			$query = $db->query($sql);
			while($row = $query->fetch(PDO::FETCH_ASSOC)){
			?>
            <tr>
            <td><?php echo $row['n_category'];?></td>
            <td><?php echo $row['c'];?></td>
          </tr>
   <?php }?>
        </table>

    </div>

</body>
</html>