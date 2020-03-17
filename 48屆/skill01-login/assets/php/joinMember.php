<?php
    include_once('./pdoLink.php');
    $insert=$db->prepare("insert into member(m_username,m_password) values(:user,:pwd)");
    $select=$db->prepare("select m_username from member where m_username = :user");
    $select->bindValue(':user',$_POST['username']);
    $select->execute();
    $result=$select->fetch(PDO::FETCH_ASSOC);
    if ((bool)$result){
        echo "註冊失敗，有相同的使用者名稱!";
    }else{
        $insert->bindValue(':user',$_POST['username']);
        $insert->bindValue(':pwd',md5($_POST['password']));
        $insert->execute();
        echo "註冊成功";
    }
?>