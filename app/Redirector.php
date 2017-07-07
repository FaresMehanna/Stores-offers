<?php

//include all the pages
require_once(dirname(__FILE__).'/../all.php');

Class Redictor{

	private $message;
	private $url;

	public function __construct(){
		$this->message = "Redirecting ......";
	}

	public function setURL($url){
		$this->url = $url;
	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function execute(){

		if(empty($this->url))
			throw new Exception("No URL to be redirected");
			
		echo '<!DOCTYPE html>
		<html>
		<head>
		<meta http-equiv="refresh" content="0;url=';
			echo $this->url;
		echo '">
		<title>يتم تحويلك الان</title>
		<script language="javascript">
		    window.location.href = "';
			echo $this->url;
		    echo '"
		</script>
		</head>
		<body>
		<a href="';
		echo $this->url;
		echo '">';
		echo $this->message;
		echo '</a>
		</body>
		</html>
		';

		exit();
	}
}