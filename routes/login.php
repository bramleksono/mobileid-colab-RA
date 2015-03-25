<?php

$app->get('/login', function () use($app, $twig) {
	$login=array(
	    'pagetitle' => 'Login - MobileID RA',
	    'heading' => 'Mobile ID RA Application',
		'subheading' => 'Enter User Name and Password Below',
		'license' => 'Mobile ID RA Application',
		'year' => '2015',
		'author' => 'Bramanto Leksono',
	);
	
	if (isset($_SESSION['slim.flash']['error'])) {
		$alert=array('alert' => $_SESSION['slim.flash']['error']);
		$login = array_merge($login, $alert);
	}
	
	echo $twig->render('login.html',$login );
});

$app->post('/process', function () use ($app, $twig) {
    $username = $app->request()->post("username");
    $password = $app->request()->post("password");
    
    if ($username == "") {
		//invalid input
		$app->flash('error', 'Input is not valid. Please enter correct input');
		$app->redirect('/login');
	} else {
		//check user input with RA user database
		$controller = new RAController;
		$result = $controller->compareUserPassword($username, $password);
		if ($result) {
			$controller->startSession($username);
			$app->redirect('/home');
		} else {
			$app->flash('error', 'Wrong User Name and Password. Please enter correct input');
			$app->redirect('/login');			
		}
	}
});

$app->get('/logout', function () use ($app) {
	$controller = new RAController;
	$controller->endSession();
	$app->redirect('/');
});