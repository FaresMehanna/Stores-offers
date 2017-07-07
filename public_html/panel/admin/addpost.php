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
	$cats = new Categories();

	//for user information
	$post = new PostEngine();
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
		$post_id = $_POST['postid'];
		$category = $_POST['category'];

		$post->addPost($name,$post_id,$category);
	}

	/*
	Handle Get requests
	*/

	//render the template
	$template->render("addpost");
?>