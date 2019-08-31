<?php

//database connection here
    include_once '../config/database.php';
    include_once '../objects/lead.php';

    //instantiate database and lead object
    $database = new Database();
    $db = $database->getConnection();

    //initialize object
    $lead = new Lead($db);
    
    $submission = array();
    
    $submission["first_name"] = mysqli_real_escape_string($db, $_REQUEST['first_name']);
    $submission["last_name"] = mysqli_real_escape_string($db, $_REQUEST['last_name']);
    $submission["email"] = mysqli_real_escape_string($db, $_REQUEST['email']);
    $submission["phone"] = mysqli_real_escape_string($db, $_REQUEST['phone']);
    $submission["comments"] = mysqli_real_escape_string($db, $_REQUEST['comments']);
    $submission["city"] = mysqli_real_escape_string($db, $_REQUEST['city']);
    $submission["area_coming_from"] = mysqli_real_escape_string($db, $_REQUEST['area_coming_from']);

    if($lead->add($submission)){
        //set response code - 200 ok
        http_response_code(200);
    }else{
        //set response code to 404 not found
        http_response_code(404);

        //tell the user no leads found
        echo json_encode(
            array("message" => "No Leads Found.")
        );
    }


?>