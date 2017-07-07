<?php

require_once(dirname(__FILE__).'/../all.php');


Class Recommender{

	private $db;
	private $conn;

	public function __construct(){
		$this->db = new RecDatabase();
		$this->conn = $this->db->getConnection();
	}

	public function getAllData($site_id){
		$sql = "SELECT userid,postid,ts FROM visits WHERE site = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_prarm('i',$site_id);
		$query->execute();
		$query->store_result();

		$result = array();
		$query->bind_result($result['userid'],$result['postid'],$result['ts']);
		$data = array();
		while($query->fetch()){
			$data[] = $result;
			$result = array();
			$query->bind_result($result['userid'],$result['postid'],$result['ts']);
		}

		return $data;
	}

	public function getPostsData($site_id){
		$sql = "SELECT postid FROM visits WHERE site = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('i',$site_id);
		$query->execute();
		$query->store_result();

		$query->bind_result($result);
		$data = array();
		while($query->fetch()){
			$data[] = $result;
			$result;
			$query->bind_result($result);
		}

		return $data;
	}

	public function getPostsDataCount($site_id){
		$sql = "SELECT postid FROM visits WHERE site = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('i',$site_id);
		$query->execute();
		$query->store_result();

		$query->bind_result($result);
		$data = array();
		while($query->fetch()){

			if(isset($data[$result]))
				$data[$result]++;
			else
				$data[$result] = 0;

			$result;
			$query->bind_result($result);
		}

		return $data;
	}
}

?>