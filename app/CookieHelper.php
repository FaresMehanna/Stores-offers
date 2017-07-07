<?php

//include all the pages
require_once(dirname(__FILE__).'/../public_html/panel/all.php');

Class CookieHelper{
	public function __construct(){
	}

	public function reNew($name){
		setcookie($name, $_COOKIE[$name], time() + (86400 * 30), '/');
	}

	public function set($name,$value){
		setcookie($name, $value, time() + (86400 * 30), '/');
	}

	public function uSet($name){
		unset($_COOKIE[$name]);
		setcookie($name, null, -1, '/');
	}
}

?>