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
			titleCss = {
				'font-size':$("[name=ts]").val() +'px',
				'color':$("[name=tc]").val(),
			}
			contentCss = {
				'font-size':$("[name=cs]").val() +'px',
				'color':$("[name=cc]").val(),
			}
			titleCss = JSON.stringify(titleCss).replace(/"/g,'').replace(/,/g,';');
			contentCss = JSON.stringify(contentCss).replace(/"/g,'').replace(/,/g,';');
			var css = `.news>header${titleCss}.news>main${contentCss}`;
			$("[name=css]").val(css);
			return true;	
		});
	});
</script>

</head>


<body>
	<div class="container">
    	<header>新增版型</header>
        <a class="fill" href="index.php">回電子報製作精靈</a>
        <form method="post" id="layoutForm" action="addLayoutProcess.php" enctype="multipart/form-data">
            <table>
                <tr>
                    <td>版型名稱</td>
                    <td><input type="text" name="title" required/></td>
                </tr>
                <tr>
                    <td>標題大小</td>
                    <td><input type="text" name="ts" required/></td>
                </tr>
                <tr>
                    <td>標題顏色</td>
                    <td>
                      	<input type="color" name="tc" />
                    </td>
                </tr>
                <tr>
                    <td>內文大小</td>
                    <td><input type="text" name="cs" required/></td>
                </tr>
                <tr>
                    <td>內文顏色</td>
                    <td>
                      	<input type="color" name="cc" />
                    </td>
                </tr>
                <tr>
                    <td>
                        背景圖片
                    </td>
                    <td>
                    	<input type="file" name="img" class="ui-button"/>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"><button type="submit">新增</button>
                    <button type="reset">重設</button></td>
                </tr>
            </table>
            <input type="hidden" name="css" />
           </form>
    </div>
</body>
</html>