<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'database.php';
include_once 'Utente.php';
 
$database = new Database();
$db = $database->getConnection();
 
$giochi = new Utente($db);
 
$data = json_decode(file_get_contents("php://input"));

$giochi->mail = $data->mail;
$giochi->name = $data->name;
$giochi->password = $data->password;
$giochi->sede = $data->sede;
 
if($giochi->update()){
    http_response_code(200);
    echo json_encode(array("risposta" => "Utente aggiornato"));
}else{    
    http_response_code(503);						//503 service unavailable
    echo json_encode(array("risposta" => "Impossibile aggiornare utente"));
}
?>