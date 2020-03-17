<?php
	include_once("../db.php");
	date_default_timezone_set("Asia/Taipei");
	
	session_start();
	
	if(!isset($_SESSION['loginError'])){
		$_SESSION['loginError'] = 0;
	}
	
	$user = $_POST['username'];
	$pwd = $_POST['password'];
	$captcha_ans = $_POST['ans'];
	$captcha = $_POST['capt'];
	
	$sql = 'select * from user where u_username = :user';
	
	$query = $db->prepare($sql);
	$query->bindValue(':user',$user);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	
	if($result == false){
		err();
		echo "<script>alert('帳號錯誤');location.href='login.php'</script>";
	}elseif($result['u_password'] != $pwd){
		err();
		echo "<script>alert('密碼錯誤');location.href='login.php'</script>";
	}elseif($captcha != $captcha_ans){
		err();
		echo "<script>alert('驗證碼錯誤');location.href='login.php'</script>";
	}else{
		$sql = 'update user set u_login = :time where u_id = :id';
		$query = $db->prepare($sql);
		$query->bindValue(':time',date('Y-m-d H:i:s'));
		$query->bindValue(':id',$result['u_id']);
		$query->execute();
		$_SESSION['login'] = $result['u_type'];
		header('location:../index.php');	
	}
	
	function err(){
		$_SESSION['loginError'] +=1;
		if($_SESSION['loginError'] >=3){
			unset($_SESSION['loginError']);
			echo "<script>location.href='loginError.php'</script>";
			
			
		}
		
	}
	
?>