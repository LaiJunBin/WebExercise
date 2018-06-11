<?php
    include_once('db.php');

    $sql = 'insert into workers(w_id) values(:key)';

    $query = $db->prepare($sql);
    $query->bindValue(':key',$_POST['key']);
    $query->execute();


?>