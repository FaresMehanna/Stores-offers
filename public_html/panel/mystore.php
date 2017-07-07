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

	//for user information
	$store = new Store();
?>

<?php

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

	//store website
	$storeUrl = $storeInf['website_url'];

	//store Id
	$storeId = $storeInf['id'];

	/*
	Handle Post requests
	*/

	if($_SERVER['REQUEST_METHOD'] === "POST"){

		//get new Name
		$newStoreName = $_POST['name'];

		//get new URL
		$newStoreUrl = $_POST['website_url'];

		//set the store ID and make the update
		$store->setId($storeId);
		$store->updateStoreName($newStoreName);
		$store->updateStoreUrl($newStoreUrl);

		//check if the there is any error
		if($store->error()){
			//print the error and render the page
			$template->setMessage('<p style="color:red">'.$store->errorMessage().'</p>');
			$template->render("mystore");
		}else{
			//update the information to display
			$storeName = $newStoreName;
			$storeUrl = urlencode($newStoreUrl);
			//render the page with succ message
			$template->setMessage('<p style="color:green">Updated successfully</p>');
			$template->render("mystore");
		}
	}

	/*
	Handle Get requests
	*/

	//render the template
	$template->render("mystore");
?>