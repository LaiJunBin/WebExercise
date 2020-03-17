<?php

    class account{

        private $db = null;
        
        public function __construct(){
            include_once('db.php');
            $this->db = $db;
        }

        public function get(){

            $token = $this->getAuthorizationToken();
            
            $account = $_GET['account'];
                
            $record = $this->selectRecord([
                'account' => $account,
                'token' => $token
            ]);

            $account_is_exists = !($record==false);

            $xml = null;
            if(!$account_is_exists){
                $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data success="0" status="404"/>');
            }else{
                $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data success="1" status="200"/>');
                $xml->addChild('account',$record['account']);
                $xml->addChild('bio',$record['bio']);
                $xml->addChild('created',$record['created']);
            }
        
            echo $xml->asXml();
        }

        public function post(){

            $data = file_get_contents('PHP://input');
            $POST = new SimpleXMLElement($data);
            foreach($POST as $key => $value)
            {
                $$key = $value;
            }

            $record = $this->selectRecord([
                'account' => $account
            ]);

            $account_is_exists = !($record==false);
        
            $xml = null;
            if($account_is_exists){
                $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data type="string" success="0" status="400">此帳號已經被註冊</data>');
            }else{
                $random_data = bin2hex(random_bytes(4));
                $token = mb_substr($random_data,0,-1);
                $sql = 'insert account(account,bio,created,token) values(:account,:bio,:created,:token)';
                $query = $this->db->prepare($sql);
                $query->bindValue(":account",$account);
                $query->bindValue(":bio",$bio);
                $query->bindValue(":created",time());
                $query->bindValue(":token",$token);
                $query->execute();
                
                $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data type="string" success="1" status="200">'.$token.'</data>');
            }
        
            echo $xml->asXml();
        }

        public function patch(){
            $token = $this->getAuthorizationToken();
            $account = $_GET['account'];
            $record = $this->selectRecord([
                'account' => $account,
                'token' => $token
            ]);

            $account_is_exists = !($record==false);

            $xml = null;
            if($account_is_exists){
                $data = file_get_contents('PHP://input');
                $POST = new SimpleXMLElement($data);
                
                $sql = "update account set ";
            
                foreach($POST as $key => $value){
                    $sql .= "{$key}=:{$key},";
                }
                $sql = mb_substr($sql,0,-1);
                $sql.= " where account=:_account and token=:token";

                $query = $this->db->prepare($sql);
                foreach($POST as $key => $value){
                    $query->bindValue(":{$key}",$value);
                    
                }
                $query->bindValue(':_account',$account);
                $query->bindValue(':token',$token);
                $query->execute();

                $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data success="1" status="200"/>');

            }else{
                $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data success="0" status="404"/>');
            }
            echo $xml->asXml();
        }

        public function delete(){
            $token = $this->getAuthorizationToken();
            $account = $_GET['account'];
            $record = $this->selectRecord([
                'account' => $account,
                'token' => $token
            ]);

            $account_is_exists = !($record==false);

            $xml = null;
            if($account_is_exists){
                $sql = "delete from account where account=:account and token =:token ";

                $query = $this->db->prepare($sql);
                $query->bindValue(':account',$account);
                $query->bindValue(':token',$token);
                $query->execute();

                $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data success="1" status="200"/>');

            }else{
                $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><data success="0" status="404"/>');
            }
            echo $xml->asXml();

        }

        private function getAuthorizationToken(){
            $headers = apache_request_headers();
            list($key,$value) = explode(' ',$headers['Authorization']);
            return $value;
        }

        private function selectRecord($condition){
            $keys = array_keys($condition);
            $sql = 'select * from account';
            if(count($keys)>0){
                $sql .= ' where';
                foreach($keys as $key){
                    $sql .= " $key = :{$key} and";
                }
                $sql = mb_substr($sql,0,-4);
            }
            $query = $this->db->prepare($sql);
            foreach($keys as $key){
                $query->bindValue(":{$key}",$condition[$key]);
            }
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }
    }

?>