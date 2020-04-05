<?php

    class QueryItem{
        private $db = null;
        private $table = null;
        public $data = null;

        public function __construct($db, $table, $data) {
            $this->db = $db;
            $this->table = $table;
            $this->data = $data;
        }

        public static function fromArray($db, $table, $array){
            $output = [];
            foreach($array as $item){
                array_push($output, new QueryItem($db, $table, $item));
            }
            return $output;
        }

        public function update($params){
            if($this->data == null){
                return;
            }
            
            $keys = implode(',',array_map(function($key){
                return $key.'=:'.$key;
            },array_keys($params)));

            $conditionKeys = implode(' and ',array_map(function($key){
                return $key.'=:c'.$key;
            },array_keys($this->data)));

            $conditions = array_combine(array_map(function($key){
                return 'c'.$key;
            },array_keys($this->data)),array_values($this->data));

            $sql = "update {$this->table} set {$keys} where {$conditionKeys}";

            foreach($params as $key => $value){
                $this->data[$key] = $value;
            }

            $this->bindAll($sql, array_merge($params, $conditions));
        }

        public function delete(){
            if($this->data == null){
                return;
            }

            $conditionKeys = implode(' and ',array_map(function($key){
                return $key.'=:'.$key;
            },array_keys($this->data)));

            $sql = "delete from {$this->table} where {$conditionKeys}";
            
            $this->bindAll($sql,$this->data);
            $this->data = null;
        }

        public function get(){
            return $this->data;
        }


        private function bindAll($sql,$params){
            $query = $this->db->prepare($sql);
            foreach($params as $key => $value){
                $query->bindValue($key,$value);
            }
            $query->execute();

            if($query->errorinfo()[2] != ""){
                echo $sql.'<br>'.$query->errorinfo()[2];
                exit;
            }

            return $query;
        }
    }

    class DatabaseQuery{
        public $table = null;
        private $db = null;
        private $items = null;

        public function __construct($db, $table, $items=null) {
            $this->db = $db;
            $this->table = $table;
            $this->items = $items ?? QueryItem::fromArray($db, $table, $this->select([])->fetchAll(PDO::FETCH_ASSOC));
        }

        public function count(){
            return count($this->items);
        }

        public function create($params){
            $keys = implode(',',array_keys($params));

            $bindKeys = implode(',',array_map(function($key){
                return ':'.$key;
            },array_keys($params)));

            $sql = "insert into {$this->table}({$keys}) values({$bindKeys})";

            $this->bindAll($sql,$params);
            return $this->db->lastInsertId();
        }

        public function update($params){
            foreach($this->items as $item){
                $item->update($params);
            }
        }

        public function delete(){
            foreach($this->items as $item){
                $item->delete();
            }
        }

        public function get(){
            return array_map(function($item){
                return $item->data;
            }, $this->items);
        }

        public function find($conditions){
            foreach($this->items as $item){
                $data = $item->data;
                foreach($conditions as $key => $value){
                    if($data[$key] != $value){
                        continue 2;
                    }
                }                
                return $item;
            }
            return new QueryItem($this->db, $this->table, null);
        }

        public function where($conditions){
            $output = new DatabaseQuery($this->db, $this->table, []);
            foreach($this->items as $item){
                $data = $item->data;
                foreach($conditions as $key => $value){
                    if($data[$key] != $value){
                        continue 2;
                    }
                }                
                array_push($output->items, $item);
            }

            return $output;
        }

        public function first(){
            return $this->items[0] ?? null;
        }

        public function contains($conditions){
            foreach($this->items as $item){
                $data = $item->data;
                foreach($conditions as $key => $value){
                    if($data[$key] != $value){
                        continue 2;
                    }
                }
                return true;
            }

            return false;
        }

        public function map($func){
            $items = array_map(function($item) use($func){
                return $func($item->data);
            }, $this->items);

            $output = new DatabaseQuery($this->db, $this->table, QueryItem::fromArray($this->db, $this->table, $items));
            return $output;
        }

        private function select($conditions){

            $sql = "select * from {$this->table}";

            if(count($conditions) > 0){
                $conditionKeys = implode(' and ',array_map(function($key){
                    return $key.'=:'.$key;
                },array_keys($conditions)));

                $sql .= " where {$conditionKeys}";
            }

            return $this->bindAll($sql,$conditions);
        }

        private function bindAll($sql,$params){
            $query = $this->db->prepare($sql);
            foreach($params as $key => $value){
                $query->bindValue($key,$value);
            }
            $query->execute();

            if($query->errorinfo()[2] != ""){
                echo $sql.'<br>'.$query->errorinfo()[2];
                exit;
            }

            return $query;
        }

    }

    class Database{
        private static $db = null;

        public static function use($db){
            self::connection_db();
            return new DatabaseQuery(self::$db, $db);
        }

        private static function connection_db(){
            if(self::$db == null){
                $db_host = "your host";
                $db_name = "your db name";
                $username = "your username";
                $password = "your password";
                self::$db = new PDO("mysql:host={$db_host};dbname={$db_name}", $username, $password);
                self::$db->exec('set names utf8');
            }
        }

        public static function execute($sql, $params=[]){
            self::connection_db();
            
            $query = self::$db->prepare($sql);
            foreach($params as $key => $value){
                $query->bindValue($key,$value);
            }
            $query->execute();

            if($query->errorinfo()[2] != ""){
                echo $sql.'<br>'.$query->errorinfo()[2];
                exit;
            }

            if(mb_substr(trim($sql), 0, 6) == 'select'){
                $table = array_values(array_filter(explode(' ', mb_substr($sql, mb_strpos(mb_strtolower($sql), 'from'))), function($d){
                    return $d !== '';
                }))[1];
                return new DatabaseQuery(self::$db, $table, QueryItem::fromArray(self::$db, $table, $query->fetchAll(PDO::FETCH_ASSOC)));
            } else if(mb_substr(trim($sql), 0, 6) == 'insert'){
                return self::$db->lastInsertId();
            }

        }
    }