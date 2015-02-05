<?php

$app->get('/home', function () use($app,$twig) {
	$username = 'Bramanto Leksono';
	$greet = "Selamat datang, ".$username.". Pilih menu disamping untuk memulai.";
	
	$display=array(
	    'pagetitle' => 'Menu Utama - MobileID RA',
	    'heading' => 'Petunjuk',
	    'subheading' => $greet,
	    'username' => $username,
		'license' => 'Aplikasi RA - Mobile ID',
		'year' => '2015',
		'author' => 'Bramanto Leksono',
	);
	echo $twig->render('home.tmpl',$display);
	
});
