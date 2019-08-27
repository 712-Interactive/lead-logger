<?php
    class Database{

        //Datbase Credentials
        private $host = "ec2-34-202-165-151.compute-1.amazonaws.com";
        private $db_name = "lead-logger";
        private $username = "ec2-user";
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