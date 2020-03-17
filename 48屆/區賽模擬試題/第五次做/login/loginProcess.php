<?php
	
	include_once('../db.php');
	session_start();
	date_default_timezone_set('Asia/Taipei');
	
	$keys = array_keys($_POST);
	foreach($keys as $key){
		$$key = $_POST[$key];	
	}
	
	if(!isset($_SESSION['loginError'])){
			$_SESSION['loginError'] = 0;
	}
	
	$sql = 'select * from user where u_user = :user';
	$query = $db->prepare($sql);
	$query->bindValue(":user",$user);
	$query->execute();
	$res = $query->fetch(PDO::FETCH_ASSOC);
	if($res == false){
		$_SESSION['loginError']++;
		if($_SESSION['loginError']>=3){
			$_SESSION['loginError']=0;
			header('location:loginErr.php');
			exit();	
		}
		echo "<script>alert('帳號錯誤');location.href='./index.php'</script>";
	}else if($res['u_pwd'] != $pwd){
		$_SESSION['loginError']++;
		if($_SESSION['loginError']>=3){
			$_SESSION['loginError']=0;
			header('location:loginErr.php');
			exit();	
		}
		echo "<script>alert('密碼錯誤');location.href='./index.php'</script>";
	}else if($captcha != $ans){
		$_SESSION['loginError']++;
		if($_SESSION['loginError']>=3){
			$_SESSION['loginError']=0;
			header('location:loginErr.php');
			exit();	
		}
		echo "<script>alert('驗證碼錯誤');location.href='./index.php'</script>";
	}else{
		$_SESSION['login'] = $res['u_type'];
		$_SESSION['loginId'] = $res['u_id'];
		$sql = 'update user set u_login=:login where u_id = :id';
		$query = $db->prepare($sql);
		$query->bindValue(":login",date('Y-m-d H:i:s'));
		$query->bindValue(":id",$res['u_id']);
		$query->execute();
		echo "<script>alert('登入成功');location.href='../index.php'</script>";
	}
?>