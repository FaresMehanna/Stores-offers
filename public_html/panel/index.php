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

	//for benshmarking information
	$benchmarks = new Benchmarking();


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
	$postsData = $posts->getAllPosts();

	//Mark the posts if with the price and the availbility
	$postsData = $posts->MarkPosts($postsData,$storeInf['id']);
	
	//get all categoried from database
	$cats = $categories->getAll();

	//get all posts benshmarks data
	$postsBenchData = $benchmarks->getXXdata();

	//get this month data
	$benchmarksData = $benchmarks->getThisMonthData($userInf['store_id']);
	$benchmarksData['numAvailable'] =
	 $benchmarks->getNumberOfAvailbleProducts($userInf['store_id']);

	//daily data
	$dailyData = $benchmarks->getDaysData($userInf['store_id'],'10');

	//render the template
	$template->render("index");
?>