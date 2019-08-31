<?php
    class Database{
        //Datbase Credentials
        private $host = "lead-logger.c2mzbr5ung8u.us-east-1.rds.amazonaws.com";
        private $db_name = "leadLoggerDB";
        private $username = "admin_712_int";
        private $password = "NeiwmuR1bgHdOCAERi2o";
        public $conn;

        //get database connection
        public function getConnection(){

            $this->conn = null;

            try{
                $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
                $this->conn->exec("set names utf8");
                echo "Connected Successfully";
            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }
?>