<?php
    class Response{
        private $response = null;
        private $isJSON = false;

        public function __construct($res = null) {
            $this->response = $res;
            $this->isJSON = false;
            return $this;
        }

        public function json($json_data=[]){
            header('Content-Type: application/json');
            $this->response = $json_data;
            $this->isJSON = true;
            return $this;
        }

        public function api($status, $message, $data){
            return $this->json(compact('status', 'message', 'data'));
        }

        public function fromControllerApi($controller, $function, ...$args){
            include_once('src/controller/'.$controller.'.php');
            $instance = new $controller();

            try {
                return call_user_func_array([$instance, $function], $args);
            } catch (\TypeError $th) {
                return call_user_func_array([$instance, $function], array_merge([$GLOBALS['request']], $args));
            }
        }

        public function code($code=200){
            http_response_code($code);
            return $this;
        }

        public function error($code=404, $json_data=null){
            http_response_code($code);
            $error_file = "./errors/{$code}.php";
            if($json_data == null && file_exists($error_file)){
                require_once($error_file);
            }else if(is_array($json_data) && count($json_data) > 0){
                return $this->json($json_data);
            }else{
                http_response_code(500);
            }
            exit;
        }

        public function __toString(){
            if($this->isJSON){
                return json_encode($this->response);
            }

            return (string)$this->response;
        }
        
        public function __get($name) {
            if($this->isJSON){
                if(array_key_exists($name, $this->response))
                    return $this->response[$name];
            }

            user_error("Invalid property: " . __CLASS__ . "->$name");
        }
    }