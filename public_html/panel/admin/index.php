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

	//for store information
	$bench = new Benchmarking();

	//check Logged In
	$login->checkAdminLogIn();

	//get user ID
	$userId = $login->getLogInAdminId();

	//get user Information
	$userInf = $user->getAdminInf($userId);

	$stores = $store->getAllStores();
	foreach ($stores as &$store) {
		$store['bench'] = $bench->getThisMonthData($store['id']);
		$store['days'] = $bench->getDaysData($store['id'],20,'<=');
		$store['bench']['numAvailable'] =
	  	 $bench->getNumberOfAvailbleProducts($store['id']);
	}

	//render the template
	$template->render("adminindex");
?>