<?php
    include_once('./pdoLink.php');
    $select=$db->prepare("select * from member where m_username = :user and m_password =:pwd");
    $select->bindValue(':user',$_POST['username']);
    $select->bindValue(':pwd',md5($_POST['password']));
    $select->execute();
    $result=$select->fetch(PDO::FETCH_ASSOC);
    if($result != ''){
        echo "登入成功!";
    }else{
        echo "帳號或密碼錯誤!";
    }
?>