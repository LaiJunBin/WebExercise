<?php

    function uncamelize($camelCaps,$separator='_')
    {
        return strtolower(preg_replace('/([a-z])([A-Z])/', "$1" . $separator . "$2", $camelCaps));
    }

    class Validate{
        private $status;
        private $data;

        public function __construct($status){
            $this->status = $status;
            $this->data = [];
        }

        public static function require($input, $require_fields){
            $validate = new Validate(true);
            return self::_require($input, $require_fields, $validate, $validate->data);
            return $validate;
        }

        private static function _require($input, $require_fields, $validate, &$data){

            if($validate->fails() || is_array($input) && count($require_fields) > count($input)){
                $validate->status = false;
                return $validate;
            }

            foreach($require_fields as $require_field_key => $require_field_value){
                
                if(is_array($require_field_value)){
                    // foreach($require_field_value as $field){
                    if(array_key_exists($require_field_key, $input)){
                        if($require_field_key === 0){
                            foreach($input as $next_input){
                                $data[] = [];
                                Validate::_require($next_input, $require_field_value, $validate, $data[count($data)-1]);
                            }
                        }else{
                            if(!isset($validate->data[uncamelize($require_field_key)]))
                                $validate->data[uncamelize($require_field_key)] = [];

                            if(is_array($input[$require_field_key]) && count($input[$require_field_key]) > 0)
                                Validate::_require($input[$require_field_key], $require_field_value, $validate, $validate->data[uncamelize($require_field_key)]);
                        }
                    }else{
                        $validate->status = false;
                        return $validate;
                    }
                    // }
                } else {
                    if(!array_key_exists($require_field_value, $input)){
                        $validate->status = false;
                        return $validate;
                    }
                    $data[uncamelize($require_field_value)] = $input[$require_field_value];
                }
            }

            return $validate;
        }

        public function fails(){
            return $this->status === false;
        }

        public function data(){
            return $this->data;
        }
    }