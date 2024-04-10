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
 
$giochi->mail = $data->e_mail;

$myfile = fopen("logs.txt", "a");
$txt = date("Y-m-d H:i:s")." --> e_mail: ".$data->e_mail."   password: ".$data->password."\n";
fwrite($myfile, $txt);
fclose($myfile);

$stmt = $giochi->login();						// legge i dati col metodo read creato da noi
$num = $stmt->rowCount();

if($num>0){								// se vengono trovati utenti nel database 
    $giochi_arr = array();						// array di utenti
    $giochi_arr["records"] = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $gioco_item = array(						// crea un array con i dati (stile formato json)
            "mail" => $e_mail,
            "name" => $nome,
            "password" => $password,
            "sede" => $sede
        );
        if($gioco_item['password'] == $data->password){
            http_response_code(200);
            array_push($giochi_arr["records"], $gioco_item);
        }else{
            http_response_code(400);
        }
    }
    echo json_encode($giochi_arr);					// restituisce i dati in formato json
}
else {
    http_response_code(503);
    echo json_encode( array("message" => "Nessun Developer Trovato.")  );
}
?>