<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");					// indica che usa il metodo post
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'database.php';
include_once 'Giochi.php';
 
$database = new Database();
$db = $database->getConnection();
$giochi = new Giochi($db);
$data = json_decode(file_get_contents("php://input"));			// prende il contenuto URL e lo converte da  JSON a PHP		
									
if( !empty($data->nome) && !empty($data->descrizione) && !empty($data->mail_editore) && !empty($data->data_pubblicazione)&& !empty($data->main_img)){
	$giochi->nome = $data->nome;
	$giochi->descrizione = $data->descrizione;
	$giochi->prezzo = $data->prezzo;
	$giochi->sconto = $data->sconto;
	$giochi->mail_editore = $data->mail_editore;
	$giochi->main_img = $data->main_img;
	$giochi->data_pubblicazione = $data->data_pubblicazione;
     

    if($giochi->create()){
        http_response_code(200);
        echo json_encode(true);
       }
    else{
        http_response_code(500);				  		//503 servizio non disponibile
        echo json_encode(false);
       }
   }
else{
    http_response_code(400); 							//400 bad request
    echo json_encode(false);
   }
?>