<?php
    $request = $_GET['request'].'.php';
    require($request);
    $input = json_decode(file_get_contents('PHP://input'), true);
    echo response($input);