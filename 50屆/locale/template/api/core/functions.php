<?php
    function dd(...$params){
        foreach($params as $param){
            var_dump($param);
            echo '<br>';
        }
        exit;
    }

    function keys($array){
        return array_keys($array);
    }

    function values($array){
        return array_values($array);
    }

    function containsKey($array,$data){
        return array_search($data,keys($array)) !==false;
    }

    function contains($array,$data){
        return array_search($data,$array) !==false;
    }

    function clearEmpty(&$array){
        $array = values(array_filter($array,function($d){
            return $d !="";
        }));
    }

    function Response($res=null){
        return new Response($res);
    }

    function json($status, $message, $data){
        return json_encode(compact('status', 'message', 'data'));
    }