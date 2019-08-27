<?php
    class Database{

        //Datbase Credentials
        private $host = "34.202.165.151";
        private $db_name = "lead-logger";
        private $username = "admin_712_int";
        private $password = "NeiwmuR1bgHdOCAERi2o";
        public $conn;

        //get database connection
        public function getConnection(){

            $this->conn = null;

            try{
                $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name,$this->username,$this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Connection error: " . $exception->getMessage();
            }

            return $this->conn;
        }
    }
?>