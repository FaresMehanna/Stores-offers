<?php

//include all the pages
require_once(dirname(__FILE__).'/../all.php');

Class TemplateEngine{

	private $templatename;
	private $arr;
	private $message;

	public function __construct(){

		$this->arr = array();

		//pages for the main webstie
		$this->add('index','tempindex.php');
		$this->add('login','templogin.php');
		$this->add('mystore','tempmystore.php');
		$this->add('posts','tempposts.php');
		$this->add('singlepost','tempsinglepost.php');
	
		//pages for the admin panel
		$this->add('adminindex','tempadminindex.php');
		$this->add('adminlogin','tempadminlogin.php');
		$this->add('addpost','tempaddpost.php');
		$this->add('addcountry','tempaddcountry.php');
		$this->add('addstore','tempaddstore.php');
		$this->add('adminposts','tempadminposts.php');
	}

	public function setMessage($message){
		$this->message = $message;
	}

	private function get($name){
		foreach ($this->arr as $key => $value) {
			if($key == $name)
				return $value;
		}
		return false;
	}

	public function add($name,$file){
		$this->arr[$name] = dirname(__FILE__).'/../temp/'.$file;
	}

	public function render($name){
		if($this->get($name) != false){
			require_once($this->get($name));
			exit();
		}else{
			throw new RuntimeException("TemplateEngine : " . "Template ".$name." Not found");
		}
	}	
}

?>