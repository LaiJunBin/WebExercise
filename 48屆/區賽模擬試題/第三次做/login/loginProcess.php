<?php
	include_once('../db.php');
	date_default_timezone_set('Asia/Taipei');
	
	session_start();
	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}
	
	$sql = 'select * from user where u_username = :user';
	$query = $db->prepare($sql);
	$query->bindValue(":user",$user);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	
	if(!isset($_SESSION['loginError'])){
		$_SESSION['loginError'] = 0;
	}
	
	
	if(!$result){
		$_SESSION['loginError']++;
		if($_SESSION['loginError']>=3){
			$_SESSION['loginError'] = 0;
			header("location:loginError.php");
			exit();	
		}
		echo '<script>alert("帳號錯誤");location.href="index.php"</script>';	
	}elseif($result['u_password'] != $pwd){
		$_SESSION['loginError']++;
		if($_SESSION['loginError']>=3){
			$_SESSION['loginError'] = 0;
			header("location:loginError.php");
			exit();	
		}
		echo '<script>alert("密碼錯誤");location.href="index.php"</script>';	
	}elseif($captcha != $ans){
		$_SESSION['loginError']++;
		if($_SESSION['loginError']>=3){
			$_SESSION['loginError'] = 0;
			header("location:loginError.php");
			exit();	
		}
		echo '<script>alert("驗證碼錯誤");location.href="index.php"</script>';	
	}else{
		$_SESSION['login'] = $result['u_type'];	
		$_SESSION['loginError'] = 0;
		
		$sql = 'update user set u_login =:login where u_id = :id';
		$query = $db->prepare($sql);
		$query->bindValue(":login",date("Y-m-d H:i:s"));
		$query->bindValue(":id",$result['u_id']);
		$query->execute();
		
		
		echo '<script>alert("成功登入");location.href="../index.php"</script>';	
	}
	
?>