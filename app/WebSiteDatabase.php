<?php

require_once(dirname(__FILE__).'/../public_html/panel/all.php');

class WebSiteDatabase implements DatabaseInterface{

	//database informations
	private $dbName;
	private $dbUserName;
	private $dbUserPassword;
	private $dbHost;
	private $conn;
	private $main;

	//Set all to null
	function __construct(){
		$this->dbName = "hdslrco1_1m6421oda3";
		$this->dbUserName = "hdslrco1_fares";
		$this->dbUserPassword = "fares22356";
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