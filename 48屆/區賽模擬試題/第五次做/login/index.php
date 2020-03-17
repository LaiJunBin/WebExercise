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
		function init(maxCount=4){
			var code = [];
			$("#captchaImg,#captcha").empty();
			for(var i = 1 ; i <=maxCount; i ++){
				$.ajax({
					url:'getText.php',
					async:false,
					success:function(res){
						var image = $("<img>").attr('va',res).attr('src','plot.php?code='+res);
					
						$("#captchaImg").append(image);
						$("#captcha").append("<div></div>");
						code.push(res);
					}
				});	
			}
			code.sort();
			$("[name=captcha]").val('');
			$("[name=ans]").val(code.join(''));
			$("#captchaImg img").draggable({
				revert:'invalid',
				snap:'#captcha div',
				snapMode:'inner'
			});
			$("#captcha div").droppable({
				drop:function(event,ui){
					ui.helper.appendTo(this).css({
						top:0,
						left:0	
					});
					var u = '';
					$("#captcha img").each(function(){
						u += $(this).attr('va');
					});
					$("[name=captcha]").val(u);
				}
			});
		}
		$("#resetCaptcha").click(function(){
			init();
		});
		init();
	});
</script>
</head>

<body>

	<div class="container">
    	<header>汽車共乘網站管理 - 登入</header>
        
        <a class="fill" href="../">回首頁</a>
        <form method="post" action="loginProcess.php">
            <table align="center">
                <tr>
                    <th colspan = "2">登入</th>
                </tr>
                <tr>
                    <td>帳號</td>
                    <td><input type="text" name="user"/></td>
                </tr>
                <tr>
                    <td>密碼</td>
                    <td><input type="password" name="pwd"/></td>
                </tr>
                <tr>
                    <td>驗證碼</td>
                    <td>
                        <div id="captcha"></div>
                    </td>
                </tr>
                <tr>
                    <td><div id="captchaImg"></div></td>
                    <td><button type="button" id="resetCaptcha">驗證碼重新產生</button></td>
                </tr>
                <tr>
                    <td><button type="submit">登入</button></td>
                    <td><button type="reset">重設</button></td>
                </tr>
            </table>
            <input type="hidden" name="captcha" />
            <input type="hidden" name="ans" />
        </form>
    </div>

</body>
</html>