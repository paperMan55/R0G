<?php
class Giochi
	{
	private $conn;
	private $table_name = "giochi";
	
	public $id;
	public $nome;
	public $descrizione;
	public $prezzo;
	public $sconto;
	public $mail_editore;
	public $main_img;
	public $valutazione;
	public $data_pubblicazione;
	
	public function __construct($db)	// costruttore
		{
		$this->conn = $db;
		}
	
	function read($cercato)	{
		$query = "SELECT * FROM " . $this->table_name ." WHERE nome LIKE '%:cercato%'";

		$stmt = $this->conn->prepare($query);

		$cercato = htmlspecialchars(strip_tags($cercato));
    	$stmt->bindParam(":cercato",   $cercato);

		$stmt->execute();
		return $stmt;
	}

	function readOf($cercato)	{
		$query = "SELECT * FROM " . $this->table_name . " WHERE mail_editore=:mail_editore AND nome LIKE '%".$cercato."%'";
		$stmt = $this->conn->prepare($query);

		$this->mail_editore = htmlspecialchars(strip_tags($this->mail_editore));
    	$stmt->bindParam(":mail_editore",   $this->mail_editore);
		$cercato = htmlspecialchars(strip_tags($cercato));

		$stmt->execute();
		return $stmt;
	}
	function readId()	{
		$query = "SELECT * FROM " . $this->table_name . " WHERE id=:id";
		$stmt = $this->conn->prepare($query);

		$this->id = htmlspecialchars(strip_tags($this->id));
    	$stmt->bindParam(":id",   $this->id);

		$stmt->execute();
		return $stmt;
	}

	function create(){	 
    	$query = "INSERT INTO " . $this->table_name ." SET  nome=:nome, descrizione=:descrizione, prezzo=:prezzo, sconto=:sconto, mail_editore=:mail_editore, main_img=:main_img, data_pubblicazione=:data_pubblicazione"; 
    	$stmt = $this->conn->prepare($query);  
    	
		$this->nome = htmlspecialchars(strip_tags($this->nome));
		$this->descrizione = htmlspecialchars(strip_tags($this->descrizione));
		$this->prezzo = htmlspecialchars(strip_tags($this->prezzo));
		$this->sconto = htmlspecialchars(strip_tags($this->sconto));
		$this->mail_editore = htmlspecialchars(strip_tags($this->mail_editore));
		$this->main_img = htmlspecialchars(strip_tags($this->main_img));
		$this->data_pubblicazione = htmlspecialchars(strip_tags($this->data_pubblicazione));
			
    	$stmt->bindParam(":nome",   $this->nome);	
    	$stmt->bindParam(":descrizione",   $this->descrizione);	
    	$stmt->bindParam(":prezzo",   $this->prezzo);	
    	$stmt->bindParam(":sconto",   $this->sconto);	
    	$stmt->bindParam(":mail_editore",   $this->mail_editore);	
    	$stmt->bindParam(":main_img",   $this->main_img);	
    	$stmt->bindParam(":data_pubblicazione",   $this->data_pubblicazione);	

    	if($stmt->execute()) return true;
    	return false;    
	}


	function update(){
    	$query = "UPDATE " . $this->table_name ." SET  nome=:nome, descrizione=:descrizione, prezzo=:prezzo, sconto=:sconto, mail_editore=:mail_editore, main_img=:main_img, valutazione=:valutazione, data_pubblicazione=:data_pubblicazione WHERE id=:id"; 
    	$stmt = $this->conn->prepare($query);  
    	
		$this->nome = htmlspecialchars(strip_tags($this->nome));
		$this->descrizione = htmlspecialchars(strip_tags($this->descrizione));
		$this->prezzo = htmlspecialchars(strip_tags($this->prezzo));
		$this->sconto = htmlspecialchars(strip_tags($this->sconto));
		$this->mail_editore = htmlspecialchars(strip_tags($this->mail_editore));
		$this->main_img = htmlspecialchars(strip_tags($this->main_img));
		$this->data_pubblicazione = htmlspecialchars(strip_tags($this->data_pubblicazione));
	
    	$stmt->bindParam(":nome",   $this->nome);	
    	$stmt->bindParam(":descrizione",   $this->descrizione);	
    	$stmt->bindParam(":prezzo",   $this->prezzo);	
    	$stmt->bindParam(":sconto",   $this->sconto);	
    	$stmt->bindParam(":mail_editore",   $this->mail_editore);	
    	$stmt->bindParam(":main_img",   $this->main_img);	
    	$stmt->bindParam(":data_pubblicazione",   $this->data_pubblicazione);	

    	
    	if($stmt->execute()) return true;
    	return false;    
	}

	function delete(){
		$query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    	$stmt = $this->conn->prepare($query);
    	$this->id = htmlspecialchars(strip_tags($this->id));
    	$stmt->bindParam(1, $this->id);	
    	if($stmt->execute())   return true;
    	return false;    
	}

}
?>