<?php
    class Lead{
        //dtabase connection and table name
        private $conn;
        private $table_name = "leads";

        //object properties
        public $id;
        public $first_name;
        public $last_name;
        public $email_local;
        public $email_domain_id;
        public $phone;
        public $comments;
        public $city;
        public $area_coming_from;
        public $assigned_id;
        public $converted;

        //constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
        }

        //read leads
        function read(){
            //select all query
            $query = "SELECT
                       *
                        FROM
                        " . $this->table_name . "
                        ORDER BY
                            id DESC
                    ";

            //prepare query statement
            $stmt = $this->conn->prepare($query);

            //execute query
            $stmt->execute();

            return $stmt;
        }
    }
