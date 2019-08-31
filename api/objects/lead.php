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

        function add($data){
            $insert_statement = "INSERT INTO  
                    " . $this->table_name . "
                    (first_name, last_name, email_local, email_domain_id, phone, comments, city, area_coming_from) 
                    VALUES
                    (:first_name, :last_name, :email_local, :email_domain_id, :phone, :comments, :city, :area_coming_from)";

            $first_name = $data['first_name'];
            $last_name = $data['last_name'];
            $email_arr = explode($data['email'], "@");
            $email_local = $email_arr[0];
            $email_domain_id = getDomainID($email_arr[1]);
            $phone = preg_replace('/[^A-Za-z0-9\-]/', str_replace('-','',$data['phone']));
            $comments = $data['comments'];
            $city = $data['city'];
            $area_coming_from = $data['area_coming_from'];



            $insert = $this->conn->prepare($insert_statement);
            if($insert->execute()){
                echo "New record created successfully";
                return read();
            }else{
                echo "Unable to create record";
                return false;
            }


        }
    }
