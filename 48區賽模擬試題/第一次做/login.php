<?php
date_default_timezone_set('Asia/Taipei');
	session_start();
	if(empty($_SESSION['loginError'])){
		$_SESSION['loginError'] = 0;	
	}
	include_once('db.php');
	$sql = 'select * from login where l_username = :user';
	$query = $db->prepare($sql);
	$query->bindValue('user',$_POST['username']);
	$query->execute();
	$result = $query->fetch(PDO::FETCH_ASSOC);
	if(!$result){
		checkError();
		echo "<script>alert('帳號錯誤');location.href='./index.php?login'</script>";	
	}elseif($result['l_password'] !=$_POST['password']){
		checkError();
		echo "<script>alert('密碼錯誤');location.href='./index.php?login'</script>";		
	}elseif($_POST['captcha_ans'] != $_POST['captcha']){
		checkError();
		echo "<script>alert('驗證碼錯誤');location.href='./index.php?login'</script>";		
	}else{
		unset($_SESSION['loginError']);
		$_SESSION['login'] = $_POST['username'];
		$_SESSION['login_type'] = $result['l_type'];
		
		$sql = 'update login set l_login = :date where l_id=:id';
		$query = $db->prepare($sql);
		$query->bindValue(':date',date('Y-m-d H:i:s'));
		$query->bindValue(':id',$result['l_id']);
		$query->execute();
		
		header('location:index.php');
	}
	
	function checkError(){
		$_SESSION['loginError']+=1;
		if($_SESSION['loginError']>=3){
			unset($_SESSION['loginError']);
			header('location:loginError.html');
			exit();	
		}
	}
	
?>