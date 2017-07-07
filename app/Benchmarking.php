<?php

//include all the pages
require_once(dirname(__FILE__).'/../all.php');
date_default_timezone_set('Africa/Cairo');

class Benchmarking{
	
	private $db;
	private $conn;

	public function __construct(){
		$this->db = new Database();
		$this->conn = $this->db->getConnection();
	}

	public function getThisMonthData($store_id){
		$sql = "SELECT id,store_id,visitors,pages,clicks,month
		 FROM monthlyvisits WHERE store_id = ? AND month = ?";
		$query = $this->conn->prepare($sql);
		$x = date("Y-m");
		$query->bind_param('is',$store_id,$x);
		$query->execute();
		$query->store_result();

		//if there is data fetch it and return
		if($query->num_rows == 1){
			$result = array();
			$query->bind_result($result['id'],$result['store_id'],$result['visitors']
				,$result['pages'],$result['clicks'],$result['month']);
			$query->fetch();
			$result['visitors'] = floor($result['visitors']*1.3);
			return $result;
		}
	}

	public function getDaysData($store_id,$days,$ob = '<'){
		$d = date("Y-m-d");
		$sql = "SELECT id,day,store_id,num FROM dailyvisits
		 WHERE store_id = ? AND day $ob ? ORDER BY day DESC LIMIT $days";

		$query = $this->conn->prepare($sql);
		$x = date("Y-m");
		$query->bind_param('is',$store_id,$d);
		$query->execute();
		$query->store_result();

		$result = array();
		$data = array();
		$query->bind_result($result['id'],$result['day'],$result['store_id']
				,$result['num']);
		
		$num = $query->num_rows -1;
		//if there is data fetch it and return
		while($query->fetch()){
			$data[$num--] = $result;

			$result = array();
			$query->bind_result($result['id'],$result['day'],$result['store_id']
				,$result['num']);
		}

		return $data;
	}

	public function getNumberOfAvailbleProducts($store_id){
		$sql = "SELECT COUNT(*) AS numAvailable FROM available WHERE store_id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('i',$store_id);
		$query->execute();
		$query->store_result();

		//if there is data fetch it and return
		if($query->num_rows == 1){
			$query->bind_result($result);
			$query->fetch();
			return $result;
		}
	}

	public function getXXdata(){
		$sql = "SELECT post_id,percentage FROM XX";
		$query = $this->conn->prepare($sql);
		$query->execute();
		$query->store_result();

		$result = array();
		$data = array();
		$query->bind_result($result['post_id'],$result['percentage']);

		while($query->fetch()){
			$data[$result['post_id']] = $result['percentage'];
			$result = array();
			$query->bind_result($result['post_id'],$result['percentage']);
		}
		return $data;
	}

	public function updatePostXX($post_id,$percentage){
		$sql = "UPDATE XX set percentage = ? WHERE post_id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('di',$percentage,$post_id);
		$query->execute();
	}
}