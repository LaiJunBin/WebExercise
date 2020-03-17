<?php
    include_once('./pdoLink.php');
    $select = $db -> prepare('select m_date from member where m_username = :user');
    $select->bindValue(':user',$_POST['username']);
    $select->execute();
    $result = $select->fetch(PDO::FETCH_ASSOC);
    if($result != false){
        echo $result['m_date'];
    }else{
        echo '沒有這個會員資料';
    }
?>