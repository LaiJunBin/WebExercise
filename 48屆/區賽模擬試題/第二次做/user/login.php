<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>汽車共乘網站管理 - 登入</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="../css/main.css">
<?php
	session_start();
	include_once("../db.php");
?>

<style>
	#captcha div{
		width:30px;
		height:30px;
		border:1px solid #333;
		display:inline-block;
	}
</style>

</head>
<script>
	function fsubmit(){
		var code = '';
		$("#captcha img").each(function(){
			code += $(this).attr('va');
		});
		console.log(code);
		$("[name=capt]").val(code);
		return true;
	}
	function initCaptcha(maxCount){
		var code = [];
		$("#captchaImg,#captcha").html('');
		for(var i = 1 ; i <=maxCount ; i++){
			$.ajax({
				url:'captcha/getText.php',
				async:false,
				success:function(c){
					code.push(c)
					var image = document.createElement("img");
					image.src = "captcha/plot.php?code=" + c;
					$(image).attr('va',c);
					$("#captcha").append("<div></div>");
					$("#captchaImg").append(image);
				}
			});
			code.sort();
			$("[name=ans]").val(code.join(''));
			$("#captchaImg img").draggable({
				revert:"invalid",
				snap:"#captcha div",
				snapMode:"inner",
				
			});
			
			$("#captcha div").droppable({
				appect:'#captchaImg img',
				drop:function(event,ui){
					ui.helper.appendTo(this).css({
						'left':0,
						'top':0
					});	
				}
			});
		}	
	}
	$(function(){
		initCaptcha(4);
		$("#resetCaptcha").click(function(){
			initCaptcha(4);	
		});
	});
</script>
<body>
	<div id="container">
    	<header>汽車共乘網站管理 - 登入</header>
         <a class="ui-button fill" href="../">回首頁</a>
        <form method="post" action="loginProcess.php" onsubmit="return fsubmit()">
            <table width="50%" border="0" align="center" style="line-height:30px;">
              <tr>
                <td>帳號</td>
                <td><input type="text" required name="username" /></td>
              </tr>
              <tr>
                <td>密碼</td>
                <td><input type="password" required name="password" /></td>
              </tr>
              <tr>
                <td>圖形驗證碼</td>
                <td id="captcha"></td>
              </tr>
              <tr>
                <td id="captchaImg"></td>
                <td><button type="button" id="resetCaptcha" class="ui-button">重新產生驗證碼</button></td>
              </tr>
              <tr>
                <td><button class="ui-button" type="submit">登入</button></td>
                <td><button class="ui-button" type="reset">重設</button></td>
              </tr>
            </table>
            <input type="hidden" name="ans" />
            <input type="hidden" name="capt" />
		</form>
    </div>

</body>
</html>