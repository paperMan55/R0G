<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'database.php';
include_once 'Keys.php';
 
$database = new Database();
$db = $database->getConnection();
 
$giochi = new Keys($db);
 
$data = json_decode(file_get_contents("php://input"));
 
$giochi->key = $data->key;
 
if($giochi->delete()){
    http_response_code(200);
    echo json_encode(array("risposta" => "Utente e' stato eliminato"));
}else{
    http_response_code(503);						  //503 service unavailable
    echo json_encode(array("risposta" => "Impossibile eliminare Utente."));
}
?>