<?php

    $current_dir = str_replace('\\','/',getcwd());
    $url = explode('/',$_SERVER['REQUEST_URI']);

    $root = $_SERVER['DOCUMENT_ROOT'];
    $method = strtolower($_SERVER['REQUEST_METHOD']);

    $except_url = explode('/',str_replace($root,'',$current_dir));

    clearEmpty($url);
    clearEmpty($except_url);

    for($i=0;$i<min(count($url),count($except_url));$i++){
        if($url[$i] == $except_url[$i])
            $url[$i] = '';
        else{
            Response()->code(404);
            exit;
        }
    }

    clearEmpty($url);
    $url_count = count($url);
    $url = implode('/',$url);

    $contains_page = false;

    foreach(Route::$routes[$method] ?? [] as $route){
        if($url_count == $route['len'] && preg_match($route['pattern'],$url,$matches)){
            $GLOBALS['request'] = new Request(array_combine($route['params'], array_slice($matches, 1)));
            if(is_callable($route['function'])){
                try {
                    $res = (string)call_user_func_array($route['function'], array_slice($matches, 1));
                } catch (\TypeError $th) {
                    $res = (string)call_user_func_array($route['function'], array_merge([$GLOBALS['request']], array_slice($matches, 1)));
                }
            }else{
                $object = $route['script'];
                include('src/controller/'.$object.'.php');
                $instance = new $object();
    
                try {
                    $res = (string)call_user_func_array([$instance, $route['function']], array_slice($matches, 1));
                } catch (\TypeError $th) {
                    $res = (string)call_user_func_array([$instance, $route['function']], array_merge([$GLOBALS['request']], array_slice($matches, 1)));
                }
            }

            if(empty($res)){
                return Response()->error(405);
            }

            echo $res;
            $contains_page = true;
            break;
        }
    }

    if(!$contains_page){
        return Response()->error(404);
    }