	<?php

//include all the pages
require_once(dirname(__FILE__).'/../all.php');

class DailyVisitsEngine{
	
	private $available;
	private $conn;

	public function __construct(){
		$this->available = new Availability();
		$this->db = new Database();
		$this->conn = $this->db->getConnection();
	}

	private function addVisitToStore($store_id,$day){
		$store_id = intval($store_id);
		$sql = "UPDATE dailyvisits SET num = (num+1) WHERE store_id = '$store_id'
		 AND day = \"$day\"";
		$this->conn->query($sql);
	}

	public function addVisitToStoresObserver($post_id,$day){
		$data = $this->getAllStoresWithAvailablePostId($post_id);
		foreach($data as $store_id){
			$this->addVisitToStore($store_id,$day);
		}
	}

	private function getAllStoresWithAvailablePostId($post_id){
		return $this->available->getAllStoresWithAvailablePostId($post_id);
	}
}

?>