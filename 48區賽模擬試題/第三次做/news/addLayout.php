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
</head>
<script>
	$(function(){
		$("#form").on('submit',function(){
			var titleCss = {
				'font-size':$("input[name=ts]").val()+'px',
				'color':$("input[name=tc]").val()
			}
			var contentCss = {
				'font-size':$("input[name=cs]").val()+'px',
				'color':$("input[name=cc]").val()
			}
			titleCss = '.news>header' + JSON.stringify(titleCss).replace(/"/g,'').replace(/,/g,';');
			contentCss = '.news>main'+ JSON.stringify(contentCss).replace(/"/g,'').replace(/,/g,';');
			$("input[name=css]").val(titleCss + contentCss);
			return true;
		});
	});

</script>
<body>
	<div id="container">
    	<header>電子報製作精靈</header>
    	<main>
        	<a class="fill" href="add.php">回電子報製作精靈</a>
            <form id="form" method="POST" action="addLayoutProcess.php" enctype="multipart/form-data">
                <table align="center">
                	<tr>
                        <td>
                            版型名稱
                        </td>
                        <td>
                            <input type="text" name="title" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            標題大小
                        </td>
                        <td>
                            <input type="number" name="ts" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            標題顏色
                        </td>
                        <td>
                            <input type="color" name="tc" required />
                        </td>
                    </tr>
					<tr>
                        <td>
                            內文大小
                        </td>
                        <td>
                            <input type="number" name="cs" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            內文顏色
                        </td>
                        <td>
                            <input type="color" name="cc" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            背景圖片
                        </td>
                        <td>
                            <input type="file" name="img" />
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
                <input type="hidden" name="css"  />
            </form>
            
        </main>
    </div>
</body>
</html>
