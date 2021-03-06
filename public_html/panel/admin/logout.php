<?php
	
	//include all the pages
	require_once('../all.php');

	//get database connection
	$db = new Database();
	$conn = $db->getConnection();

	//get cookie object
	$cookie = new Cookies();

	//redirector
	$redirector = new Redictor();

	//check if the user already singed in
	if($cookie->getAdminId() != -1){
		$cookie->uSetCookiesForAdmin();
		session_destroy();
	}

	//redirect to the main page
	$redirector->setURL('login.php');
	$redirector->execute();	
	
?>