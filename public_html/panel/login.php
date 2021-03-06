<?php
	

	//include all the pages
	require_once('all.php');

	//get database connection
	$db = new Database();
	$conn = $db->getConnection();

	//get cookie object
	$cookie = new Cookies();

	//template engine
	$template = new TemplateEngine();

	//redirector
	$redirector = new Redictor();

	//redirector
	$user = new User();

	//check if the user already singed in
	if($cookie->getUserId() != -1){
		//redirect to the main page
		$redirector->setURL('index.php');
		$redirector->execute();	
	}

	//Deploy the login screen if the Method was get
	if($_SERVER['REQUEST_METHOD'] == 'GET')
	{
		//redirect to the main page
		$template->render('login');
	}
	//Else start to process the data
	else
	{
		//Get the data from the POST request
		$name = $_POST['username'];
		$password = $_POST['password'];

		//check for empty data
		if(empty($name) || empty($password))
		{
			//ERROR MESSAGE
			$template->setMessage('خطأ في الأسم او كلمة المرور');
			//Deploy the temp
			$template->render('login');
		}

		//the query to database
		$userInf = $user->getUserInfByUsername($name);

		if($userInf === false)
		{
			//ERROR MESSAGE
			$template->setMessage('خطأ في الأسم او كلمة المرور');
			//Deploy the temp
			$template->render('login');
		}
		else
		{
			if(!password_verify($password,$userInf['password']))
			{
				//ERROR MESSAGE
				$template->setMessage('خطأ في الأسم او كلمة المرور');
				//Deploy the temp
				$template->render('login');
			}

			//set cookie data
			$cookie->setCookiesForUser($userInf['id']);

			//redirect to the main page
			$redirector->setURL('index.php');
			$redirector->setMessage('تم تسجيل الدخول بنجاح');
			$redirector->execute();
		}
	}
?>