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
		$("#layoutForm").on('submit',function(){
			var title = {
				'font-size':$("#ts").val() + 'px',
				'color':$("#tc").val(),
			}
			var note = {
				'font-size':$("#cs").val() + 'px',
				'color':$("#cc").val(),
			}
			title = JSON.stringify(title).replace(/"/g,'').replace(/,/g,';');
			note = JSON.stringify(note).replace(/"/g,'').replace(/,/g,';');
			title = '#news>header'+title;
			note = '#news main'+note;
			$("[name=css]").val(title+note);
			return true;
		});
	});
</script>
</head>

<body>

	<div class="container">
    	<header>新增版型</header>
        
        <a class="fill" href="add.php">回電子報製作精靈</a>
        <form method="post" action="addLayoutProcess.php" id="layoutForm" enctype="multipart/form-data">
            <table align="center">
                <tr>
                    <th colspan = "2">新增版型</th>
                </tr>
                <tr>
                    <td>版型標題</td>
                    <td><input type="text" name="title" required/></td>
                </tr>
                <tr>
                    <td>標題大小</td>
                    <td><input type="text" id="ts" required/></td>
                </tr>
                <tr>
                    <td>標題顏色</td>
                    <td><input type="color" id="tc"/></td>
                </tr>
                <tr>
                    <td>內文大小</td>
                    <td><input type="text" id="cs" required/></td>
                </tr>
                <tr>
                    <td>內文顏色</td>
                    <td><input type="color" id="cc"/></td>
                </tr>
                <tr>
                    <td>背景圖片</td>
                    <td>
                    <input type="file" name="img"/>
                    </td>
                </tr>
                <tr>
                    <td><button type="submit">新增</button></td>
                    <td><button type="reset">重設</button></td>
                </tr>
            </table>
			<input type="hidden" name="css" />
        </form>
    </div>

</body>
</html>