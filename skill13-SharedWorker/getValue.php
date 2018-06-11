<?php
    include_once('db.php');

    $sql = 'select w_content from workers where w_id = :key';

    $query = $db->prepare($sql);
    $query->bindValue(':key',$_POST['key']);
    $query->execute();

    $result = $query->fetch(PDO::FETCH_ASSOC);

    echo $result['w_content'];

?>