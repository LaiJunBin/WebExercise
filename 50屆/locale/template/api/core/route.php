<?php

    class Route{
        static $routes = [];
        static $route_table = [];
        private static $prefix = '';

        static function get($url,$action){
            self::process("get", $url, $action);
        }

        static function post($url,$action){
            self::process("post", $url, $action);
        }

        static function put($url,$action){
            self::process("put", $url, $action);
        }

        static function patch($url,$action){
            self::process("patch", $url, $action);
        }

        static function delete($url,$action){
            self::process("delete", $url, $action);
        }

        static function group($prefix, $func){
            self::$prefix .= '/'.$prefix;
            $func();
            self::$prefix = '';
        }

        static function process($method,$url,$action){
            if(!containsKey(self::$routes,$method)){
                self::$routes[$method] = [];
                self::$route_table[$method] = [];
            }

            $url = self::$prefix.'/'.$url;
            $url = explode('/',$url);
            clearEmpty($url);
            $url = implode('/',$url);

            array_push(self::$route_table[$method], [
                'method' => $method,
                'url' => '/'.$url,
                'action' => $action,
            ]);

            preg_match_all("/{(.[^}]*)}/", $url, $params);
            $pattern = preg_replace("/{.[^}]*}/","(.*)",$url);
            $pattern = str_replace('/','\/',$pattern);
            $pattern = str_replace('?','\?',$pattern);
            $pattern = '/^'.$pattern.'$/';

            $url = explode('/',$url);
            clearEmpty($url);
            $url_count = count($url);

            if(!is_callable($action)){
                list($script,$function) = explode('@',$action);
            }else{
                $script = null;
                $function = $action;
            }

            array_push(self::$routes[$method],[
                'script'=>$script,
                'function'=>$function,
                'pattern'=>$pattern,
                'len'=>$url_count,
                'params' => $params[1]
            ]);
        }
    }