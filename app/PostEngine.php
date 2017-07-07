<?php

//include all the pages
require_once(dirname(__FILE__).'/../all.php');

class PostEngine{

	private $db;
	private $conn;
	private $available;

	public function __construct(){
		$this->db = new Database();
		$this->conn = $this->db->getConnection();
		$this->available = new Availability();
	}

	//check if the post exists in the database or not
	public function getPostData($post_id){
		$sql = "SELECT id,post_id,name,cat_id FROM posts WHERE id = ?";
		$query = $this->conn->prepare($sql);
		$query->bind_param('i',$post_id);
		$query->execute();
		$query->store_result();
		if($query->num_rows == 1){
			$result = array();
			$query->bind_result($result['id'],$result['post_id']
				,$result['name'],$result['cat_id']);
			$query->fetch();
			return $result;
		}else{
			return false;
		}
	}

	public function getAllPosts(){
		$sql = "SELECT posts.id, posts.post_id, posts.name, posts.cat_id, categories.name 
		AS cat_name FROM posts INNER JOIN categories ON posts.cat_id = categories.id";
		$query = $this->conn->prepare($sql);
		$query->execute();
		$query->store_result();

		$result = array();
		$data = array();
		$query->bind_result($result['id'],$result['post_id'],$result['name']
				,$result['cat_id'],$result['cat_name']);

		while($query->fetch()){
			$data[] = $result;
			$result = array();
			$query->bind_result($result['id'],$result['post_id'],$result['name']
					,$result['cat_id'],$result['cat_name']);
		}
		return $data;
	}

	public function getCatPosts($catId){
		$sql = "SELECT posts.id, posts.post_id, posts.name, posts.cat_id, categories.name 
		AS cat_name FROM posts INNER JOIN categories
		ON posts.cat_id = categories.id WHERE posts.cat_id = ?";
		$query = $this->conn->prepare($sql);
		$query->execute();
		$query->store_result();

		$result = array();
		$query->bind_result($result['id'],$result['post_id'],$result['name']
				,$result['cat_id'],$result['cat_name']);

		while($query->fetch()){
			$data[] = $result;
			$result = array();
			$query->bind_result($result['id'],$result['post_id'],$result['name']
					,$result['cat_id'],$result['cat_name']);
		}
		return $data;
	}

	public function MarkPosts($posts,$store_id){
		//the array which hold the new data
		$dataToReturn = array();

		//loop through the main array
		foreach($posts as $singlePost){
			//get the availability data
			$availableData = $this->available->getAvailabilityData($singlePost['id'],$store_id);

			if($availableData === false){
				$singlePost['available'] = "<p style=\"color:red\">No</p>";
				$singlePost['price'] = "null";
			}else{
				$singlePost['available'] = "<p style=\"color:green\">Yes</p>";
				$singlePost['price'] = $availableData['price'];
			}
			//add to the new array
			$dataToReturn[] = $singlePost;
		}
		//return the new array
		return $dataToReturn;
	}

	//add new post to the databse
	public function addPost($name,$post_id,$cat_id){
		if(empty($name) || empty($post_id) || empty($cat_id)
		 || !is_numeric($post_id) || !is_numeric($cat_id))
			return false;
			
		$sql = "INSERT INTO posts (name,post_id,cat_id) VALUES (?,?,?)";
		$query = $this->conn->prepare($sql);
		$query->bind_param('sii',$name,$post_id,$cat_id);
 			$query->execute();

		$insert_id = $query->insert_id;

		$sql = "INSERT INTO XX (post_id,percentage,num) VALUES (?,?,?)";
		$query = $this->conn->prepare($sql);
		$z = 0;
		$query->bind_param('idi',$post_id,$z,$z);
		return $query->execute();
	}
}
?>