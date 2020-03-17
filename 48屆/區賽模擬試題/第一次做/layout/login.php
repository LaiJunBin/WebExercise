<h1>汽車共乘 - 登入</h1>

<form action="login.php" method="post">
	<table id="loginTable" width="50%" border="0" align="center">
  <tr>
    <td>請輸入帳號:</td>
    <td><input type="text" required name="username" placeholder="請輸入帳號"></td>
  </tr>
  <tr>
    <td> 請輸入密碼:</td>
    <td><input type="text" required name="password" placeholder="請輸入密碼"></td>
  </tr>
  <tr>
    <td>圖形驗證碼:</td>
    <td><input type="text" required name="captcha" placeholder="請輸入驗證碼"></td>
  </tr>
  <tr>
    <td colspan="2">
    	<span id="captcha" class="ui-button" style="border:0;background:none;">
        	
        </span>
        <input type="hidden" name="captcha_ans" value="">
    	<button type="button" class="ui-button" id="resetCaptcha">重新產生驗證碼</button>
    </td>
    	
  </tr>
  <tr>
  	<td colspan="2">
    	<button class="ui-button" type="submit">送出</button>
        <button class="ui-button" type="reset">重設</button>
    </td>
  </tr>
</table>

	
   
    
    
</form>

<script>
	$(function(){
		function plot(){
			var code = [];
			for(var i = 1; i<=4;i++){
				$.ajax({
					url:'captcha/randomTxt.php',
					async:false,
					success:function(result){
						code.push(result);
					}
				});
			}
			var captcha = document.createElement("img");
			captcha.src = 'captcha/plot.php?code=' + code.join('');
			$("#captcha").html(captcha);
			//code.sort();
			console.log(code);
			$("[name=captcha_ans]").val(code.join(''));
		}
		$("#resetCaptcha").click(plot);
		$("#loginTable tr").find("td:first:not([colspan=2])").css({
			'background':'orange',
			'border-radius':'5px'
		});
		plot();
	});

</script>