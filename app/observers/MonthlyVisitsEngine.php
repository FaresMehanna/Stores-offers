<?php

//include all the pages
require_once(dirname(__FILE__).'/../all.php');

class MonthlyVisitsEngine{
	
	private $available;
	private $conn;
	private $post_id;
	private $data;

	public function __construct(){
		$this->available = new Availability();
		$this->db = new Database();
		$this->conn = $this->db->getConnection();
		$this->data = null;
	}

	public function setPostId($post_id){
		$this->post_id = intval($post_id);
	}

	private function addVisitToStore($store_id,$month){
		$sql = "UPDATE monthlyvisits SET pages = (pages+1) WHERE store_id = '$store_id'
		 AND month = \"$month\"";
		$this->conn->query($sql);
	}

	private function addClickToStores($store_id,$month){
		$sql = "UPDATE monthlyvisits SET clicks = (clicks+1) WHERE store_id = '$store_id'
		 AND month = \"$month\"";
		$this->conn->query($sql);
	}

	private function addVisitorToStores($store_id,$month){
		$sql = "UPDATE monthlyvisits SET visitors = (visitors+1) WHERE store_id = '$store_id'
		 AND month = \"$month\"";
		$this->conn->query($sql);
	}


	public function addVisitToStoresObserver($month){
		$data = $this->getAllStoresWithAvailablePostId();
		foreach($data as $store_id){
			$this->addVisitToStore($store_id,$month);
		}
	}

	public function addClickToStoresObserver($month){
		$this->addClickToStores($this->post_id,$month);
	}

	public function addVisitorToStoresObserver($month){
		$data = $this->getAllStoresWithAvailablePostId();
		foreach($data as $store_id){
			$this->addVisitorToStores($store_id,$month);
		}
	}

	private function getAllStoresWithAvailablePostId(){
		if($this->data === null)
			$this->data = $this->available->getAllStoresWithAvailablePostId($this->post_id);
		return $this->data;
	}
}

?>