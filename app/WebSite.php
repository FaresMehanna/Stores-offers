<?php

require_once(dirname(__FILE__).'/../public_html/panel/all.php');

class WebSite{
	private $db;
	private $conn;

	public function __construct(){
		$this->db = new WebSiteDatabase();
		$this->conn = $this->db->getConnection();
	}

	//return id,name of every post
	public function getAllPosts(){
		$sql = "SELECT id,post_title AS name FROM wp_rtyz_posts WHERE post_status = \"publish\"
		 AND post_parent = '0' AND post_type =\"post\"";
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
?>