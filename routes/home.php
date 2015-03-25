<?php

$app->get('/home', function () use($app,$twig) {

    if(isset($_SESSION["user"])){
        $username = $_SESSION["user"];
        $fullname = $_SESSION["name"];
    }
    else{
        header("Location: ./");
        die();
    }

	$greet = "Welcome, ".$username.". Select menu to get started.";
	
	$display=array(
	    'pagetitle' => 'Main Menu - MobileID RA',
	    'heading' => 'Directive',
	    'subheading' => $greet,
	    'username' => $username,
		'license' => 'Mobile ID RA Application',
		'year' => '2015',
		'author' => 'Bramanto Leksono',
	);
	echo $twig->render('home.html',$display);
	
});
