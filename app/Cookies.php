<?php

//include all the pages
require_once(dirname(__FILE__).'/../public_html/panel/all.php');

class Cookies{

	private $cookie;
	private $db;
	private $conn;
	private $user;
	
	public function __construct(){
		$this->cookie = new CookieHelper();
		$this->db = new Database();
		$this->conn = $this->db->getConnection();
		$this->user = new User();
	}

	public function getUserId(){
		//if the UserId saved in session return it
		if(isset($_SESSION['user_id'])){
			return $_SESSION['user_id'];
		}
		//else check if there is cookies
		else if(isset($_COOKIE['id']) && isset($_COOKIE['hashy'])){

			$userInf = $this->user->getUserInf($_COOKIE['id']);

			if($userInf != -1)
			{
				if($this->getHashValue($userInf['id'],$userInf['username'],$userInf['email'],
					$userInf['password']) == $_COOKIE['hashy'])
				{					
					$this->cookie->reNew('id');
					$this->cookie->reNew('hashy');

					$_SESSION['user_id'] = $_COOKIE['id'];
					return $_COOKIE['id'];
				}
			}
			$this->cookie->unSet('id');
			$this->cookie->unSet('hashy');
		}
		//else return -1 as there is no active login
		return '-1';
	}

	public function getAdminId(){
		//if the UserId saved in session return it
		if(isset($_SESSION['admin_id'])){
			return $_SESSION['admin_id'];
		}
		//else check if there is cookies
		else if(isset($_COOKIE['aid']) && isset($_COOKIE['ahashy'])){

			$userInf = $this->user->getAdminInf($_COOKIE['aid']);

			if($userInf != -1)
			{
				if($this->getHashValue($userInf['id'],$userInf['username'],$userInf['email'],
					$userInf['password']) == $_COOKIE['ahashy'])
				{					
					$this->cookie->reNew('aid');
					$this->cookie->reNew('ahashy');

					$_SESSION['admin_id'] = $_COOKIE['aid'];
					return $_COOKIE['aid'];
				}
			}
			$this->cookie->unSet('aid');
			$this->cookie->unSet('ahashy');
		}
		//else return -1 as there is no active login
		return '-1';
	}

	public function setCookiesForUser($id){
		
		//get the user data
		$userInf = $this->user->getUserInf($id);

		//set the cookies value
		$this->cookie->set('id',$userInf['id']);
		$this->cookie->set('hashy',$this->getHashValue($userInf['id'],$userInf['username'],
			$userInf['email'],$userInf['password']));
	}

	public function setCookiesForAdmin($id){
		
		//get the user data
		$userInf = $this->user->getAdminInf($id);

		//set the cookies value
		$this->cookie->set('aid',$userInf['id']);
		$this->cookie->set('ahashy',$this->getHashValue($userInf['id'],$userInf['username'],
			$userInf['email'],$userInf['password']));
	}

	public function uSetCookiesForUser(){
		//un set the cookies value
		$this->cookie->uSet('id');
		$this->cookie->uSet('hashy');
	}

	public function uSetCookiesForAdmin(){
		//un set the cookies value
		$this->cookie->uSet('aid');
		$this->cookie->uSet('ahashy');
	}

	public function getHashValue($x,$y,$z,$l){
		$sum = $x*2 + 45;
		return md5($sum.$y.$z.$l);
	}
}