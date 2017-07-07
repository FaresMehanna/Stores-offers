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

	//to set the cookies as store owner
	$cook = new Cookies();

	//to set the cookies as store owner
	$redirect = new Redictor();

	//check Logged In
	$login->checkAdminLogIn();

	//get user ID
	$userId = $login->getLogInAdminId();

	//get user Information
	$userInf = $user->getAdminInf($userId);

	//get the store ID
	$store_id = $_GET['id'];

	//get information about store
	$storeInf = $store->getStoreInf($store_id);

	//if there is no store with that information
	if($storeInf == false)
		exit("WRONG STORE ID");

	//check if the user already singed in
	if($cook->getUserId() != -1){
		$cook->uSetCookiesForUser();
		session_destroy();
	}

	//if there is get the user data
	$userInf = $user->getUserInfByStoreId($store_id);

	//set cookie for as store owner
	$cook->setCookiesForUser($userInf['id']);

	//redirect to main page
	$redirect->setURL('http://stores.h-dslr.com/panel/');
	$redirect->execute();
?>