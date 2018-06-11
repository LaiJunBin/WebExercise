<?php
    include_once('db.php');

    $sql = 'update workers set w_content = :content where w_id = :key';

    $query = $db->prepare($sql);
    $query->bindValue(':content',$_POST['content']);
    $query->bindValue(':key',$_POST['key']);
    $query->execute();

    

?>