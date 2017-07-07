<?php

	session_start();

	/*
		Debugging session is OFF
	*/
	//Display errors for Debuging pupose
	//ini_set('display_errors', 1);
	//ini_set('display_startup_errors', 1);
	//error_reporting(E_ALL);
	//ini_set('max_execution_time', 60); //300 seconds = 5 minutes
	//mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_STRICT);

	//require all classes
	require_once(dirname(__FILE__).'../../app/Cookies.php');
	require_once(dirname(__FILE__).'/../../app/CookieHelper.php');
	require_once(dirname(__FILE__).'/../../app/Redirector.php');
	require_once(dirname(__FILE__).'/../../app/TemplateEngine.php');
	require_once(dirname(__FILE__).'/../../app/Database.php');
	require_once(dirname(__FILE__).'/../../app/User.php');
	require_once(dirname(__FILE__).'/../../app/Store.php');
	require_once(dirname(__FILE__).'/../../app/LogIn.php');
	require_once(dirname(__FILE__).'/../../app/PostEngine.php');
	require_once(dirname(__FILE__).'/../../app/Categories.php');
	require_once(dirname(__FILE__).'/../../app/Availability.php');
	require_once(dirname(__FILE__).'/../../app/Benchmarking.php');
	require_once(dirname(__FILE__).'/../../app/Country.php');
	require_once(dirname(__FILE__).'/../../app/WebSite.php');
	require_once(dirname(__FILE__).'/../../app/WebSiteDatabase.php');
	require_once(dirname(__FILE__).'/../../app/Reco.php');
	require_once(dirname(__FILE__).'/../../app/RecDatabase.php');

?>