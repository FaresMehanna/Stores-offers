<?php

	//include all the pages
	require_once('all.php');

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
	$login->checkLogIn();

	//get user ID
	$userId = $login->getLogInUserId();

	//get user Information
	$userInf = $user->getUserInf($userId);

	//get store Information
	$storeInf = $store->getStoreInf($userInf['store_id']);

	//store name
	$storeName = $storeInf['name'];


	//get all the posts from the database
	$data = $posts->getAllPosts();

	//Mark the posts if with the price and the availbility
	$data = $posts->MarkPosts($data,$storeInf['id']);
	
	//get all categoried from database
	$cats = $categories->getAll();

	//render the template
	$template->render("posts");
?>