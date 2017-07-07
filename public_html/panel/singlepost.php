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

	//redirector
	$redirector = new Redictor();

	//for user information
	$user = new User();

	//for store information
	$store = new Store();

	//for Posts information
	$posts = new PostEngine();

	//for categories information
	$categories = new Categories();

	//for availbility of single post
	$available = new Availability();


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

	//store id
	$store_id = $storeInf['id'];

	//get the post id
	$post_id = $_GET['id'];

	//get the post data
	$postData = $posts->getPostData($post_id);

	//check the validity of the post id
	if($postData === false){
		$redirector->setURL('posts.php');
		$redirector->execute();
	}


	if($_SERVER['REQUEST_METHOD'] == "POST"){

		//get the posted data
		$url = $_POST['url'];
		$price = $_POST['price'];

		if(isset($_POST['delete'])){

			//make un available
			$available->makeUAvailable($post_id,$store_id);

			//get availability data
			$availableInf = $available->getAvailabilityData($post_id,$store_id);

			//render the page with succ message
			$template->setMessage('<label style="color:green">Removed successfully</label>');
			$template->render("singlepost");
		}

		//make available
		$available->makeAvailable($post_id,$store_id,$price,$url);

		//check if the there is any error
		if($available->error()){

			//get availability data
			$availableInf = $available->getAvailabilityData($post_id,$store_id);

			//print the error and render the page
			$template->setMessage('<label style="color:red">'.$available->errorMessage().'</label>');
			$template->render("singlepost");

		}else{

			//get availability data
			$availableInf = $available->getAvailabilityData($post_id,$store_id);

			//render the page with succ message
			$template->setMessage('<label style="color:green">Updated successfully</label>');
			$template->render("singlepost");
		}
	}


	//get availability data
	$availableInf = $available->getAvailabilityData($post_id,$store_id);

	//render the template
	$template->render("singlepost");
?>