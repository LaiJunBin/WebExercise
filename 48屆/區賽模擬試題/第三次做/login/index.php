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
		function init(maxCount){
			var code = [];
			$("#captchaDrag,#captchaDrop").html('');
			for(var i = 1 ; i <=maxCount; i ++){
				$.ajax({
					url:"captcha/getText.php",
					async:false,
					success:function(res){
						code.push(res);
						var image = document.createElement("img")
						image.src = "captcha/plot.php?code="+res;
						$(image).attr('va',res);
						$("#captchaDrag").append(image);
						$("#captchaDrop").append("<div></div>");
					}
				});
			}
			code.sort();
			$("input[name=ans]").val(code.join(''));
			$("#captchaDrag img").draggable({
				snap:"#captchaDrop div",
				snapMode:'inner'
			});
			
			$("#captchaDrop div").droppable({
				drop:function(event,ui){
					ui.helper.appendTo(this).css({
						left:0,
						top:0
					});
					var current = [];
					$("#captchaDrop img").each(function(){
						current.push($(this).attr('va'));
					});
					$("input[name=captcha]").val(current.join(''));
				}
			});	
		}
		$("#captchaReset").click(function(){
			init(4);
		})
		init(4);
	});
</script>

</head>

<body>
	<div id="container">
    	<header>汽車共乘網站管理 - 登入</header>
    	<main>
        	<a class="fill" href="../index.php">回首頁</a>
            <form method="POST" action="loginProcess.php">
                <table align="center">
                    <tr>
                        <td>
                            帳號
                        </td>
                        <td>
                            <input type="text" name="user" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            密碼
                        </td>
                        <td>
                            <input type="password" name="pwd" required />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            圖片驗證碼
                        </td>
                        <td>
                            <div id="captchaDrop"></div>
                        </td>
                    </tr>
                    <tr>
                        <td>	
                            <div id="captchaDrag"></div>
                        </td>
                        <td>
                            <button type="button" id="captchaReset">驗證碼重新產生</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button type="submit">登入</button>
                        </td>
                        <td>
                            <button type="reset">重設</button>
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="captcha" />
                <input type="hidden" name="ans" />
            </form>
        </main>
    </div>
</body>
</html>
