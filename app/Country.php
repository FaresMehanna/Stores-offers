<?php

//include all the pages
require_once(dirname(__FILE__).'/../all.php');

class Countries{
	
	private $db;
	private $conn;

	public function __construct(){
		$this->db = new Database();
		$this->conn = $this->db->getConnection();
	}

	public function addCountry($name){
		$sql = "INSERT INTO countries (name) VALUES (?)";
		$query = $this->conn->prepare($sql);
		$query->bind_param('s',$name);
		return $query->execute();
	}

	public function getCountries(){
		$sql = "SELECT id,name FROM countries";
		$query = $this->conn->prepare($sql);
		$query->execute();
		$query->store_result();

		$result = array();
		$data = array();
		$query->bind_result($result['id'],$result['name']);

		while($query->fetch()){
			$data[] = $result;
			$result = array();
			$query->bind_result($result['id'],$result['name']);
		}
		return $data;
	}
}