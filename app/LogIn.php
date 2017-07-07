<?php

	//include all the pages
require_once(dirname(__FILE__).'/../public_html/panel/all.php');

	class LogIn{

		//get cookie object
		private $cookie;
		//redirector
		private $redirector;

		public function __construct(){
			$this->cookie = new Cookies();
			$this->redirector = new Redictor();
		}

		public function checkLogIn(){
			//check if the user already singed in
			if($this->cookie->getUserId() == -1){
				//redirect to the main page
				$this->redirector->setURL('login.php');
				$this->redirector->execute();	
			}
			return true;
		}

		public function checkAdminLogIn(){
			//check if the user already singed in
			if($this->cookie->getAdminId() == -1){
				//redirect to the main page
				$this->redirector->setURL('login.php');
				$this->redirector->execute();	
			}
			return true;
		}

		public function getLogInUserId(){
			return $this->cookie->getUserId();
		}

		public function getLogInAdminId(){
			return $this->cookie->getUserId();
		}
	}

?>