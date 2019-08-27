<?php
    //required headers
    header("Access-Control-Allow-Origin");
    header("Content type: application/json; charset=UTF-8");

    //database connection here
    include_once '../config/database.php';
    include_once '../objects/product.php';

    //instantiate database and product object
    $database = new Database();
    $db = $database->getConnection();

    //initialize object
    $lead = new Lead($db);

    //query leads
    $stmt = $lead->read();
    $num = $stmt->rowCount();

    //check if more than 0 records found
    if($num>0){

        //lead array
        $leads_arr=array();
        $leads_arr["records"]=array();

        //retrieve table contents
        //fetch() is faster than fetchAll()
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            //extract row
            // this will make $row['name'] to
            // just $name only

            extract('row');

            $lead_item=array(
                "id" => $id,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "email_local" => $email_local,
                "email_domain_id" => $email_domain_id,
                "phone" => $phone,
                "comments" => $comments,
                "city" => $city,
                "area_coming_from" => $area_coming_from,
                "assigned_id" => $assigned_id,
                "converted" => $converted
            );

            array_push($leads_arr["records"], $lead_item);
        }

        //set response code - 200 ok
        http_response_code(200);

        //show leads data in json format
        echo json_encode($leads_arr);
    }else{
        //set response code to 404 not found
        http_response_code(404);

        //tell the user no leads found
        echo json_encode(
            array("message" => "No Leads Found.")
        );
    }
