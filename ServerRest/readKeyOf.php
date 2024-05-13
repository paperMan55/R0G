<?php

header("Access-Control-Allow-Origin: *");				
header("Content-Type: application/json; charset=UTF-8");		

include_once 'database.php';						
include_once 'Keys.php';


$database = new Database();						// crea un oggetto Database e si collega al database
$db = $database->getConnection();

$giochi = new Keys($db);
 
$giochi->game_id = $_GET["game_id"];

$stmt = $giochi->readFromGame();						// legge i dati col metodo read creato da noi

$num = $stmt->rowCount();

if($num>0){								// se vengono trovati utenti nel database 
    $giochi_arr = array();						// array di utenti
    $giochi_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $gioco_item = array(						// crea un array con i dati (stile formato json)
            "game_id" => $game_id,
            "key" => $key,
        );
        array_push($giochi_arr["records"], $gioco_item);
    }
    echo json_encode($giochi_arr);					// restituisce i dati in formato json
}
else
    echo json_encode( array("message" => "Nessun gioco Trovato.")  );

?>