<?php

header("Access-Control-Allow-Origin: *");				
header("Content-Type: application/json; charset=UTF-8");		

include_once 'database.php';						
include_once 'Giochi.php';


$database = new Database();						// crea un oggetto Database e si collega al database
$db = $database->getConnection();

$giochi = new Giochi($db);
 
$giochi->mail_editore = $_GET["mail"];

$stmt = $giochi->readOf();						// legge i dati col metodo read creato da noi
$num = $stmt->rowCount();

if($num>0){								// se vengono trovati utenti nel database 
    $giochi_arr = array();						// array di utenti
    $giochi_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $gioco_item = array(						// crea un array con i dati (stile formato json)
            "id" => $id,
            "nome" => $nome,
            "descrizione" => $descrizione,
            "prezzo" => $prezzo,
            "sconto" => $sconto,
            "mail_editore" => $mail_editore,
            "main_img" => $main_img,
            "valutazione" => $valutazione,
            "data_pubblicazione" => $data_pubblicazione
        );
        array_push($giochi_arr["records"], $gioco_item);
    }
    echo json_encode($giochi_arr);					// restituisce i dati in formato json
}
else
    echo json_encode( array("message" => "Nessun gioco Trovato.")  );

?>