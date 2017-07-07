<?php

//include all the pages
require_once(dirname(__FILE__).'/../all.php');

class Store{

	private $db;
	private $conn;
	private $id;
	private $error;

	public function __construct(){
		$this->db = new Database();
		$this->conn = $this->db->getConnection();
		$this->error = "";
	}

	public function getStoreInf($storeId){
		$sql = "SELECT id,name,country_id,website_url FROM stores WHERE id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('i',$storeId);
		$query->execute();
		$query->store_result();

		if($query->num_rows == 1){
			$result = array();
			$query->bind_result($result['id'],$result['name'],$result['country_id']
				,$result['website_url']);
			$query->fetch() ; 
			return $result;
		}
		return false;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function updateStoreName($newStoreName){

		if(empty($newStoreName)){
			$this->error .= "Store name can't be empty !"."<br>";
			return false;
		}

		$sql = "UPDATE stores SET name = ? WHERE id = ?";
		$query = $this->conn->prepare($sql);
		if($query->bind_param('si',$newStoreName,$this->id))
			if($query->execute())
				return true;

		$this->error .= "update Failed, try again later"."<br>";
		return false;
	}

	public function getAllStores(){
		$sql = "SELECT stores.id,stores.name,stores.country_id, stores.website_url,
		 countries.name AS country_name FROM stores INNER JOIN countries ON
		  countries.id = stores.country_id";
		$query = $this->conn->prepare($sql);
		$query->execute();
		$query->store_result();

		$result = array();
		$query->bind_result($result['id'],$result['name'],$result['country_id']
				,$result['website_url'],$result['country_name']);

		while($query->fetch()){
			$data[] = $result;
			$result = array();
			$query->bind_result($result['id'],$result['name'],$result['country_id']
				,$result['website_url'],$result['country_name']);
		}
		return $data;
	}

	public function updateStoreUrl($newStoreUrl){
		$newStoreUrl = urlencode($newStoreUrl);

		if(empty($newStoreUrl)){
			$this->error .= "Store website can't be empty !"."<br>";
			return false;
		}

		$sql = "UPDATE stores SET website_url = ? WHERE id = ?";
		$query = $this->conn->prepare($sql);
		if($query->bind_param('si',$newStoreUrl,$this->id))
			if($query->execute())
				return true;
			
		$this->error .= "update Failed, try again later"."<br>";
		return false;
	}

	public function error(){
		if(empty($this->error))
			return false;
		return true;
	}

	public function errorMessage(){
		return $this->error;
	}

	public function addStore($name,$country,$url){
		$sql = "INSERT INTO stores (name,country_id,website_url) VALUES (?,?,?)";
		$query = $this->conn->prepare($sql);
		$query->bind_param('sis',$name,$country,$url);
		
		if($query->execute()){
			$store_id = $query->insert_id;
			$this->prepareStore($store_id);
			return $query->insert_id;
		}
			return false;
	}

	private function prepareStore($store_id){
		
		$date = new DateTime(date('Y-m-d'));
		for($i=0;$i<120;$i++){
			$d = $date->format('Y-m');

			$sql = "INSERT INTO monthlyvisits (store_id,visitors,pages,clicks,month) VALUES (?,?,?,?,?)";
			$query = $this->conn->prepare($sql);
			$z = 0;
			$query->bind_param('iiiis',$store_id,$z,$z,$z,$d);
			$query->execute();

			$date->add(new DateInterval('P1M'));
		}

		$date = new DateTime(date('Y-m-d'));
		for($i=0;$i<3650;$i++){
			$d = $date->format('Y-m-d');

			$sql = "INSERT INTO dailyvisits (store_id,num,day) VALUES (?,?,?)";
			$query = $this->conn->prepare($sql);
			$query->bind_param('iis',$store_id,$z,$d);
			$query->execute();

			$date->add(new DateInterval('P1D'));
		}

		$this->setStoreStatus('1',$store_id);
	}

	public function getStoreStatus($store_id){
		$sql = "SELECT status FROM effective WHERE store_id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('i',$store_id);
		$query->execute();
		$quety->store_result();

		if($query->num_rows != 1)
			return false;
		
		$query->bind_result($status);
		$query->fetch();
		return $result;
	}

	public function setStoreStatus($status,$store_id){
		$sql = "INSERT INTO effective (status,store_id) VALUES (?,?)";
		$query = $this->conn->prepare($sql);
		$query->bind_param('ii',$status,$store_id);

		return $query->execute();
	}
}
?>