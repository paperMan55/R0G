<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");					// indica che usa il metodo post
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'database.php';
include_once 'Utente.php';
 
$database = new Database();
$db = $database->getConnection();
$giochi = new Utente($db);
$data = json_decode(file_get_contents("php://input"));			// prende il contenuto URL e lo converte da  JSON a PHP		
									
if( !empty($data->mail) && !empty($data->name) && !empty($data->password) && !empty($data->sede) ){
    $giochi->mail = $data->mail;
    $giochi->name = $data->name;
    $giochi->password = $data->password;
    $giochi->sede = $data->sede;
    
    if($giochi->create()){
        http_response_code(201);
        echo json_encode(array("message" => "Utente creato correttamente."));
       }
    else{
        http_response_code(503);				  		//503 servizio non disponibile
        echo json_encode(array("message" => "Impossibile creare utente."));
       }
   }
else{
    http_response_code(400); 							//400 bad request
    echo json_encode(array("message" => "Impossibile creare utente i dati sono incompleti."));
   }
?>