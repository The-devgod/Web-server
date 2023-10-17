<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '/xampp/htdocs/REST_API/config/Database.php';
include_once '/xampp/htdocs/REST_API/models/Post.php';

$database = new Database();
$db = $database->connect();

$category = new Category($db);


//Category read query
$result = $post->read();

//Get row count
$num = $result->rowCount();

//Check if any category
if($num > 0){


    //Category array
    $cat_arr = array();
    $cat_arr['data'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $cat_item = array(
            'id' =>$id,
            'name' => $name,
        );


        //Push to data
        array_push($cat_arr['data'], $cat_item);
    }

    //Turn to json & output
    echo json_encode($cat_arr);
}else{
echo json_encode(
    array('message' =>'No Categories found')
);
}

