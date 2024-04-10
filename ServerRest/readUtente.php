<?php
									// preleva dei dati dal database e li restituisce in formato json 

header("Access-Control-Allow-Origin: *");				// tutti possono accedere alla pagina
header("Content-Type: application/json; charset=UTF-8");		// restituisce in formato json UTF-8

include_once 'database.php';						
include_once 'Utente.php';


$database = new Database();						// crea un oggetto Database e si collega al database
$db = $database->getConnection();

$utente = new Utente($db);						// crea un oggetto Utente
$stmt = $utente->read();						// legge i dati col metodo read creato da noi
$num = $stmt->rowCount();

if($num>0){								// se vengono trovati utenti nel database 
    $utente_arr = array();						// array di utenti
    $utente_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $utente_item = array(						// crea un array con i dati (stile formato json)
            "mail" => $e_mail,
            "name" => $nome,
            "password" => $password,
            "sede" => $sede
        );
        array_push($utente_arr["records"], $utente_item);
    }
    echo json_encode($utente_arr);					// restituisce i dati in formato json
}
else
    echo json_encode( array("message" => "Nessun Utente Trovato.")  );

?>