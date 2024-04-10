<?php
class Utente
	{
	private $conn;
	private $table_name = "editori";
	
	public $mail;				// colonne della tabella utente
	public $name;
	public $sede;
	public $password;
	
	public function __construct($db)	// costruttore
		{
		$this->conn = $db;
		}
	
	function read()	{
		$query = "SELECT * FROM " . $this->table_name;
		$stmt = $this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	function create(){	 
    	$query = "INSERT INTO " . $this->table_name ." SET  e_mail=:e_mail, nome=:nome, password=:password, sede=:sede"; 
    	$stmt = $this->conn->prepare($query);  
    	
		$this->mail = htmlspecialchars(strip_tags($this->mail));	
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->password = htmlspecialchars(strip_tags($this->password));
		$this->sede = htmlspecialchars(strip_tags($this->sede));
    	$stmt->bindParam(":e_mail",   $this->mail);		
    	$stmt->bindParam(":nome",   $this->name);				
    	$stmt->bindParam(":password",   $this->password);		
    	$stmt->bindParam(":sede",   $this->sede);		
    	
    	if($stmt->execute()) return true;
    	return false;    
	}


	function update(){
    	$query = "UPDATE ". $this->table_name ." SET e_mail=:e_mail, nome=:nome, password=:password, sede=:sede";
    	$stmt = $this->conn->prepare($query);

    	$this->mail = htmlspecialchars(strip_tags($this->mail));	
		$this->name = htmlspecialchars(strip_tags($this->name));
		$this->password = htmlspecialchars(strip_tags($this->password));
		$this->sede = htmlspecialchars(strip_tags($this->sede));
    	$stmt->bindParam(":e_mail",   $this->mail);		
    	$stmt->bindParam(":nome",   $this->name);		
    	$stmt->bindParam(":password",   $this->password);	
    	$stmt->bindParam(":password",   $this->sede);	
    	if($stmt->execute()) return true;
    	return false;
	}



	function delete(){
		$query = "DELETE FROM " . $this->table_name . " WHERE e_mail = ?";
    	$stmt = $this->conn->prepare($query);
    	$this->mail = htmlspecialchars(strip_tags($this->mail));
    	$stmt->bindParam(1, $this->mail);	
    	if($stmt->execute())   return true;
    	return false;    
	}
	function login(){
		$query = "SELECT * FROM " . $this->table_name . " WHERE e_mail = ?";
		$stmt = $this->conn->prepare($query);
		$this->mail = htmlspecialchars(strip_tags($this->mail));
		$this->password = htmlspecialchars(strip_tags($this->password));
		$stmt->bindParam(1, $this->mail);
		$stmt->execute();
		return $stmt;
	}
}
	
?>