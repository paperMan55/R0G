<?php
//headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");					// indica che usa il metodo post
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
include_once 'database.php';
include_once 'Keys.php';
 
$database = new Database();
$db = $database->getConnection();
$keyss = new Keys($db);
$data = json_decode(file_get_contents("php://input"));			// prende il contenuto URL e lo converte da  JSON a PHP		
									
if( !empty($data->game_id) && !empty($data->key)){
	$keyss->game_id = $data->game_id;
	$keyss->key = $data->key;
     

    if($keyss->create()){
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