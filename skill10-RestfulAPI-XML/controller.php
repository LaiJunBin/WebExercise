<?php
    $default_method = $_SERVER['REQUEST_METHOD'];
    $method = strtolower($_POST['_method'] ?? $default_method);
    
    $page = $_GET['page'];
    $request_file = "{$page}.php";

    $file_exists = file_exists($request_file);
   
    if($file_exists){
        require($request_file);
        $obj = new $page;
        if(method_exists($obj,$method)){
            $obj->$method();
        }else{
            $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data success="0" status="405">Method Not Allowed</data>');
            echo $xml->asXml();
        }
    }