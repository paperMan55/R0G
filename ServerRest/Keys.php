<?php
class Keys
	{
	private $conn;
	private $table_name = "`keys`";
	
	public $game_id;				// colonne della tabella utente
	public $key;

	
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

	function readFromGame()	{
		$query = "SELECT * FROM " . $this->table_name ." WHERE game_id = ?";
		$stmt = $this->conn->prepare($query);

		$this->game_id = htmlspecialchars(strip_tags($this->game_id));		
		$stmt->bindParam(1,   $this->game_id);		

		$stmt->execute();
		return $stmt;
	}


	function create(){	 
    	$query = "INSERT INTO " . $this->table_name ." SET  game_id=:game_id, `key`=:key"; 
    	$stmt = $this->conn->prepare($query);  
    	
		$this->game_id = htmlspecialchars(strip_tags($this->game_id));	
		$this->key = htmlspecialchars(strip_tags($this->key));			
    	$stmt->bindParam(":game_id",   $this->game_id);		
    	$stmt->bindParam(":key",   $this->key);		
    	try{
			if($stmt->execute()){
				return true;
			}
			return false;  
		}catch(PDOException $e){
			return false;
		}
    	  
	}

	function delete(){
		$query = "DELETE FROM " . $this->table_name . " WHERE `key` = ?";
    	$stmt = $this->conn->prepare($query);

		$this->key = htmlspecialchars(strip_tags($this->key));		
		$stmt->bindParam(1,   $this->key);		

    	if($stmt->execute())   return true;
    	return false;    
	}
}
	
?>