<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'database.php';
include_once 'Giochi.php';
 
$database = new Database();
$db = $database->getConnection();
 
$giochi = new Giochi($db);
 
$data = json_decode(file_get_contents("php://input"));

$giochi->id = $data->id;
$giochi->nome = $data->nome;
$giochi->descrizione = $data->descrizione;
$giochi->prezzo = $data->prezzo;
$giochi->sconto = $data->sconto;
$giochi->mail_editore = $data->mail_editore;
$giochi->main_img = $data->main_img;
$giochi->data_pubblicazione = $data->data_pubblicazione;
 
if($giochi->update()){
    http_response_code(200);
    echo json_encode(array("risposta" => "Utente aggiornato"));
}else{    
    http_response_code(503);						//503 service unavailable
    echo json_encode(array("risposta" => "Impossibile aggiornare utente"));
}
?>