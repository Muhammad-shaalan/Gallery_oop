<?php


class Database{
	public $connection;

	public function __construct(){
		$this->open_db_connection();
	}

	//OPEN CONNECTION
	public function open_db_connection(){
		$this->connection = new PDO(dsn, user, password);

		if (!$this->connection){
		  die("Connection error: ");
		}
	
	}

	public function query($sql){
		$result = $this->connection->prepare($sql);
		return $result;
	}

}

$db = new Database();


?>