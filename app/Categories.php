<?php

//include all the pages
require_once(dirname(__FILE__).'/../all.php');

class Categories{

	private $db;
	private $conn;

	public function __construct(){
		$this->db = new Database();
		$this->conn = $this->db->getConnection();
	}

	//get all the categories inside the database
	public function getAll(){
		$sql = "SELECT id,name FROM categories";
		$query = $this->conn->prepare($sql);
		$query->execute();
		$query->store_result();

		$result = array();
		$query->bind_result($result['id'],$result['name']);
		//keep fetching the data
		while($query->fetch()){
			$data[] = $result;
			$result = array();
			$query->bind_result($result['id'],$result['name']);
		}
		//return the array of the categories
		return $data;
	}
}
?>