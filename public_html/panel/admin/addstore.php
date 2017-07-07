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

	//for user information
	$store = new Store();

	//for user information
	$countriesOb = new Countries();
?>

<?php

	//check Logged In
	$login->checkAdminLogIn();

	//get user ID
	$userId = $login->getLogInAdminId();

	//get user Information
	$userInf = $user->getAdminInf($userId);

	//get categories information
	$countries = $countriesOb->getCountries();

	/*
	Handle Post requests
	*/

	if($_SERVER['REQUEST_METHOD'] === "POST"){

		$name = $_POST['name'];
		$url = urlencode($_POST['url']);
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password = password_hash($password,PASSWORD_BCRYPT);
		$country = $_POST['country'];

		$store_id = $store->addStore($name,$country,$url);
		if($store_id != false){
			$user->addUser($username,$email,$password,$store_id);
		}
	}

	/*
	Handle Get requests
	*/

	//render the template
	$template->render("addstore");
?>