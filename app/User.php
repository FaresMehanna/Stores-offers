<?php

//include all the pages
require_once(dirname(__FILE__).'/../public_html/panel/all.php');

class User{

	private $db;
	private $conn;

	public function __construct(){
		$this->db = new Database();
		$this->conn = $this->db->getConnection();
	}

	//giving user ID and return array of the the data related to the user or false
	//in case the id doesn't relate to any user
	public function getUserInf($userId){
		$sql = "SELECT id,username,email,password,store_id FROM users WHERE id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('i',$userId);
		$query->execute();
		$query->store_result();

		if($query->num_rows == 1){
			$result = array();
			$query->bind_result($result['id'],$result['username']
				,$result['email'],$result['password'],$result['store_id']);
			$query->fetch(); 
			return $result;
		}
		return false;
	}

	//giving username and return array of the the data related to the user or false
	//in case the username doesn't relate to any user
	public function getUserInfByUsername($username){
		$sql = "SELECT id,username,email,password,store_id FROM users WHERE username = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('s',$username);
		$query->execute();
		$query->store_result();

		if($query->num_rows == 1){
			$result = array();
			$query->bind_result($result['id'],$result['username']
				,$result['email'],$result['password'],$result['store_id']);
			$query->fetch(); 
			return $result;
		}
		return false;
	}

	//giving storeId and return array of the the data related to the user or false
	//in case the username doesn't relate to any user
	public function getUserInfByStoreId($store_id){
		$sql = "SELECT id,username,email,password,store_id FROM users WHERE store_id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('i',$store_id);
		$query->execute();
		$query->store_result();

		if($query->num_rows == 1){
			$result = array();
			$query->bind_result($result['id'],$result['username']
				,$result['email'],$result['password'],$result['store_id']);
			$query->fetch(); 
			return $result;
		}
		return false;
	}

	//giving user ID and return array of the the data related to the user or false
	//in case the id doesn't relate to any user
	public function getAdminInf($userId){
		$sql = "SELECT id,username,email,password FROM admins WHERE id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('i',$userId);
		$query->execute();
		$query->store_result();

		if($query->num_rows == 1){
			$result = array();
			$query->bind_result($result['id'],$result['username']
				,$result['email'],$result['password']);
			$query->fetch(); 
			return $result;
		}
		return false;
	}

	//giving username and return array of the the data related to the user or false
	//in case the username doesn't relate to any user
	public function getAdminInfByUsername($username){
		$sql = "SELECT id,username,email,password FROM admins WHERE username = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('s',$username);
		$query->execute();
		$query->store_result();

		if($query->num_rows == 1){
			$result = array();
			$query->bind_result($result['id'],$result['username']
				,$result['email'],$result['password']);
			$query->fetch(); 
			return $result;
		}
		return false;
	}

	//add user to the database
	public function addUser($username,$email,$password,$store_id){
		$sql = "INSERT INTO users (username,email,password,store_id) VALUES (?,?,?,?)";
		if($query = $this->conn->prepare($sql))
			if($query->bind_param('sssi',$username,$email,$password,$store_id))
				return $query->execute();
		return false;
	}

}
?>