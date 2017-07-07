<?php

	require_once(dirname(__FILE__).'/../all.php');

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

	//for Recommender
	$reco = new Recommender();

	//check Logged In
	$login->checkAdminLogIn();

	//array of data of site one
	$data = $reco->getPostsDataCount('1');

	$vis = 0;
	//update each post
	foreach ($data as $postId => $numVisited)
		$vis += $numVisited;

	//update each post
	foreach ($data as $postId => $numVisited) {
		$bench->updatePostXX($postId,($numVisited/$vis)*100);
	}



?>