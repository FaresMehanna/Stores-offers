<?php

//include all the pages
require_once(dirname(__FILE__).'/../all.php');

class Availability{

	private $db;
	private $conn;
	private $error;

	public function __construct(){
		$this->db = new Database();
		$this->conn = $this->db->getConnection();
		$this->error = false;
	}

	//giving postId and storeId and return the data of this specific record
	public function getAvailabilityData($post_id,$store_id){
		//get the data for the post and the store
		$sql = "SELECT id,price,url,post_id,store_id FROM available WHERE post_id = ? AND store_id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('ii',$post_id,$store_id);
		$query->execute();
		$query->store_result();

		//if there is data fetch it and return
		if($query->num_rows == 1){
			$result = array();
			$query->bind_result($result['id'],$result['price'],$result['url']
				,$result['post_id'],$result['store_id']);
			$query->fetch();
			return $result;
		}
		//else return false
		return false;
	}

	public function getAllStoresWithAvailablePostId($post_id){
		$sql = "SELECT available.store_id FROM available INNER JOIN posts ON posts.id = available.post_id WHERE posts.post_id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('i',$post_id);
		$query->execute();
		$query->store_result();

		$data = array();
		$result;
		$query->bind_result($result);

		//if there is data fetch it and return
		while($query->fetch()){
			$data[] = $result;
		}

		return $data;
	}

	public function makeAvailable($post_id,$store_id,$price,$url){
		$url = urlencode($url);
		if(!empty($price) && ($price < 0 || !is_numeric($price))){
			$this->error = "prices must be bigger than zero !".'<br>';
			return;
		}

		if($this->getAvailabilityData($post_id,$store_id) === false)
			$this->addAvailable($post_id,$store_id,$price,$url);
		else
			$this->updateAvailable($post_id,$store_id,$price,$url);
	}

	public function makeUAvailable($post_id,$store_id){

		if($this->getAvailabilityData($post_id,$store_id) === false)
			return true;
		else
			return $this->deleteAvailable($post_id,$store_id);
	}

	public function error(){
		if($this->error === false)
			return false;
		return true;
	}

	public function errorMessage(){
		return $this->error;
	}

	private function addAvailable($post_id,$store_id,$price,$url){
		$sql = "INSERT INTO available (post_id,store_id,price,url) VALUES (?,?,?,?)";
		$query = $this->conn->prepare($sql);
		$query->bind_param('iids',$post_id,$store_id,$price,$url);
		return $query->execute();
	}

	private function deleteAvailable($post_id,$store_id){
		$sql = "DELETE FROM available WHERE post_id = ? AND store_id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('ii',$post_id,$store_id);
		return $query->execute();
	}

	private function updateAvailable($post_id,$store_id,$price,$url){
		$sql = "UPDATE available SET post_id = ?, store_id = ?, price = ?,url = ? WHERE post_id = ? AND store_id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('iidsii',$post_id,$store_id,$price,$url,$post_id,$store_id);
		return $query->execute();
	}
}

?>