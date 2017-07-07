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

	//for categories information
	$cats = new Categories();

	//for post information
	$post = new PostEngine();

	//for country information
	$country = new Countries();
?>

<?php

	//check Logged In
	$login->checkAdminLogIn();

	//get user ID
	$userId = $login->getLogInAdminId();

	//get user Information
	$userInf = $user->getAdminInf($userId);

	//get categories information
	$categories = $cats->getAll();

	/*
	Handle Post requests
	*/

	if($_SERVER['REQUEST_METHOD'] === "POST"){

		$name = $_POST['name'];

		$country->addCountry($name);
	}

	/*
	Handle Get requests
	*/

	//render the template
	$template->render("addcountry");
?>