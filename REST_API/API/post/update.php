<?php

//Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
Access-Control-Allow-Methods, Authorisation, X-Requested-With');

include_once '/xampp/htdocs/REST_API/config/Database.php';
include_once '/xampp/htdocs/REST_API/models/Post.php';

$database = new Database();
$db = $database->connect();

$post = new Post($db);

//Get raw posted data
$data = json_decode(file_get_contents("php://input"));

//Set ID to update
$post->id = $data->id;

$post->title = $data->title;
$post->body = $data->body;
$post->author = $data->author;
$post->category_id = $data->category_id;

//create post
if($post->update()){
echo json_encode(
    array('message' => 'Post Updatex')
);
}else {
    echo json_encode(
        array('message' => 'Post Not Updated')
    );

}