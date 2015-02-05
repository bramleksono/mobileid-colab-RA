<?php

$app->get('/login', function () use($app, $twig) {
	$login=array(
	    'pagetitle' => 'Login - MobileID RA',
	    'heading' => 'Aplikasi MobileID RA',
		'subheading' => 'Masukkan nomor identitas untuk menggunakan aplikasi',
		'license' => 'Aplikasi RA - Mobile ID',
		'year' => '2015',
		'author' => 'Bramanto Leksono',
	);
	
	if (isset($_SESSION['slim.flash']['error'])) {
		$alert=array('alert' => $_SESSION['slim.flash']['error']);
		$login = array_merge($login, $alert);
	}
	
	echo $twig->render('login.tmpl',$login );
});

$app->post('/process', function () use ($app, $twig) {
    $idnumber = $app->request()->post("idnumber");
    if (!(strlen($idnumber) == 16)) {
		//invalid input
		$app->flash('error', 'Input tidak valid. Masukkan kembali nomor indentitas dengan benar');
		$app->redirect('/login');
	}
	else {
		//process request
		global $SIaddr;
		//echo $SIaddr."?idnumber=".$idnumber;
		//get login session
		//$loginreq = file_get_contents($SIaddr."?idnumber=".$idnumber);
		//jika loginreq kosong / tidak valid: 1. redirect ke login, 2.tampilkan pesan error.  
		//sementara
		$loginreq=$idnumber;
		//save 
		$_SESSION['idnumber']=$idnumber;
		$login=array(
			'pagetitle' => 'Login - MobileID RA',
			'heading' => 'Menunggu proses login',
			'subheading' => 'Periksa piranti untuk memberikan konfirmasi',
			'license' => 'Aplikasi RA - Mobile ID',
			'year' => '2015',
			'author' => 'Bramanto Leksono',
			'loginsession' => $loginreq,
		);
		
		echo $twig->render('wait.tmpl',$login );
		
		//$app->redirect('/home');
	}
});

$app->post('/process/check', function () use ($app) {
	$loginsession = $app->request()->post("loginsession");
	global $SIaddr;
	$req = $SIaddr."?loginsession=".$loginsession;
	echo file_get_contents($req);
});
