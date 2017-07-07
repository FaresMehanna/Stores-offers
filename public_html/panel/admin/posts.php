<?php

	//include all the pages
	require_once('../all.php');

	//get database connection
	$db = new Database();
	$conn = $db->getConnection();

	//to check Log In
	$login = new LogIn();

	//template engine
	$template = new TemplateEngine();

	//for user information
	$user = new User();

	//for store information
	$store = new Store();

	//for Posts information
	$posts = new PostEngine();

	//for categories information
	$categories = new Categories();


	//check Logged In
	$login->checkAdminLogIn();

	//get user ID
	$userId = $login->getLogInAdminId();

	//get user Information
	$userInf = $user->getAdminInf($userId);

	//get all the posts from the database
	$data = $posts->getAllPosts();

	
	//get all categoried from database
	$cats = $categories->getAll();

	//render the template
	$template->render("adminposts");
?>