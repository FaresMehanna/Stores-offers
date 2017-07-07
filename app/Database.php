<?php

require_once(dirname(__FILE__).'/../all.php');

Interface DatabaseInterface{

	//Databse
	public function getConnection();

}

class Database implements DatabaseInterface{

	//database informations
	private $dbName;
	private $dbUserName;
	private $dbUserPassword;
	private $dbHost;
	private $conn;
	private $main;

	//Set all to null
	function __construct(){
		$this->dbName = "DBNAME";
		$this->dbUserName = "DBUSERNAME";
		$this->dbUserPassword = "DBUSERPASSWORD";
		$this->dbHost = "localhost";
	}

	//Getters
	public function getConnection(){
		if($this->dbName == null || $this->dbUserPassword == null || $this->dbHost = null 
			|| $this->dbUserName == null)
			throw new RuntimeException("No data for database connection was found");
		
		$this->conn = new mysqli($this->dbHost, $this->dbUserName, $this->dbUserPassword);
	 	$this->conn->set_charset('utf8');
		// Check connection
		if ($this->conn->connect_error) {
			throw new RuntimeException("Connection failed");
		} 
		mysqli_select_db($this->conn,$this->dbName);
		
		return $this->conn;
	}
}

?>