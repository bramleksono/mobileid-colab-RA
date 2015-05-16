<?php

$app->get('/register', function () use($app,$twig) {
    if(isset($_SESSION["user"])){
        $username = $_SESSION["user"];
        $fullname = $_SESSION["name"];
    }
    else{
        header("Location: ./");
        die();
    }

	$content = '	<div class="identity form">
					  <h2>Registration Form</h2>
					  <form class="form-horizontal" action="register" method="post" enctype="multipart/form-data">
						<div class="form-group">
						  <label class="control-label col-sm-2">NIK</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="nik" placeholder="Nomor NIK">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2">Nama</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="nama" placeholder="Nama">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-3">Tempat / Tanggal Lahir</label>
						  <div class="col-sm-9">
							<input type="text" class="form-control" name="ttl" placeholder="Tempat / Tanggal Lahir">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2">Jenis Kelamin</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="jeniskelamin" placeholder="Jenis Kelamin">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2">Golongan Darah</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="goldarah" placeholder="Golongan Darah">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2">Alamat</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="alamat" placeholder="Alamat">
						  </div>
						</div>						
						<div class="form-group">
						  <label class="control-label col-sm-2">RT / RW</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="rtrw" placeholder="RT / RW">
						  </div>
						</div>						
						<div class="form-group">
						  <label class="control-label col-sm-2">Kelurahan/Desa</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="keldesa" placeholder="Kelurahan/Desa">
						  </div>
						</div>						
						<div class="form-group">
						  <label class="control-label col-sm-2">Kecamatan</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="kecamatan" placeholder="Kecamatan">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2">Agama</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="agama" placeholder="Agama">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2">Status Perkawinan</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="statperkawinan" placeholder="Status Perkawinan">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2">Pekerjaan</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="pekerjaan" placeholder="Pekerjaan">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2">Kewarganegaraan</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="kewarganegaraan" placeholder="Kewarganegaraan">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2">Berlaku hingga</label>
						  <div class="col-sm-10">
							<input type="text" class="form-control" name="berlaku" placeholder="Berlaku hingga">
						  </div>
						</div>
						<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-primary">Submit</button>
						  </div>
						</div>
					  </form>
					</div>                
				';
	
	$display=array(
	    'pagetitle' => 'Registration - MobileID RA',
	    'heading' => 'Directive',
	    'subheading' => 'Fill Registration Form for new and existing Mobile ID user',
	    'content' => $content,
	    'username' => $username,
		'license' => 'Mobile ID RA Application',
		'year' => '2015',
		'author' => 'Bramanto Leksono',
	);
	
	if (isset($_SESSION['slim.flash']['info'])) {
		$info=array('info' => $_SESSION['slim.flash']['info']);
		$display = array_merge($display, $info);
	}
	
	if (isset($_SESSION['slim.flash']['error'])) {
		$info=array('alert' => $_SESSION['slim.flash']['error']);
		$display = array_merge($display, $info);
	}
	
	echo $twig->render('home.html',$display);
	
});

$app->post('/register/', function () use ($app,$twig) {
    if(isset($_SESSION["user"])){
        $username = $_SESSION["user"];
        $fullname = $_SESSION["name"];
    }
    else{
        header("Location: ./");
        die();
    }

	//get address
	global $CAuserreg;
	global $CAuserregcheck;
	global $CAuserregconfirm;
	$idnumber = $app->request()->post("nik");
	
	$form= array(
			'nik' => $app->request()->post("nik"),
			'nama' => $app->request()->post("nama"),
			'ttl' => $app->request()->post("ttl"),
			'jeniskelamin' => $app->request()->post("jeniskelamin"),
			'goldarah' => $app->request()->post("goldarah"),
			'alamat' => $app->request()->post("alamat"),
			'rtrw' => $app->request()->post("rtrw"),
			'keldesa' => $app->request()->post("keldesa"),
			'kecamatan' => $app->request()->post("kecamatan"),
			'agama' => $app->request()->post("agama"),
			'statperkawinan' => $app->request()->post("statperkawinan"),
			'pekerjaan' => $app->request()->post("pekerjaan"),
			'kewarganegaraan' => $app->request()->post("kewarganegaraan"),
			'berlaku' => $app->request()->post("berlaku")
	);
	
	//check if empty field exist
	foreach ($form as $field) {
		if (empty($field)) {
			$error = "All column must be filled";
		}
	}

	//give message
	if (!empty($error)) {
		//TODO: using switch case for every error possibility
		$app->flash('error', $error);
		$app->redirect('/register');
	} else {
		
		//form valid
		//construct json
		$data = constregtoCA($form);
		$data = json_encode($data);
		
		//send form request to CA (save to database) and SI (create key pair)
		//$CAuserreg = "http://postcatcher.in/catchers/54ddc73c0f95ce0300000e0e";
		try {
			$response = sendjson($data,$CAuserreg);

			
			if (!empty($response)) {
				$response = json_decode($response);
				$app->flash('info', 'Pendaftaran berhasil.');
			} else {
				throw new ResourceNotFoundException();
			}
		} catch (ResourceNotFoundException $e) {
			// return 404 server error
			$app->response()->status(404);
		} catch (Exception $e) {
			$app->response()->status(400);
			$app->response()->header('X-Status-Reason', $e->getMessage());
		}
	}
	
	$jsonresponse = array(	"RegCheckAddr" => $CAuserregcheck,
							"RegConfirmAddr" => $CAuserregconfirm,
							"RegCode" => $response->regcode);
	$jsonresponse = json_encode($jsonresponse, JSON_UNESCAPED_SLASHES);
	$username = 'Bramanto Leksono';
	$content = '<div class="response">
					<img src="http://chart.apis.google.com/chart?cht=qr&amp;chs=300x300&amp;chl='.urlencode($jsonresponse). '&amp;chld=H|0" alt="QR Code" />
					<h2>Registration number: '.$response->regcode.'</h2>
				</div>';
	
	$display=array(
	    'pagetitle' => 'Registration - MobileID RA',
	    'heading' => 'Directive',
	    'subheading' => 'Scan QR Code using user device.',
	    'content' => $content,
	    'username' => $username,
		'license' => 'Mobile ID RA Application',
		'year' => '2015',
		'author' => 'Bramanto Leksono',
	);

	if (isset($_SESSION['slim.flash']['info'])) {
		$info=array('info' => $_SESSION['slim.flash']['info']);
		$display = array_merge($display, $info);
	}
	
	if (isset($_SESSION['slim.flash']['error'])) {
		$info=array('alert' => $_SESSION['slim.flash']['error']);
		$display = array_merge($display, $info);
	}
	
	echo $twig->render('postregister.html',$display);
	
	//$app->redirect('/register');
});

function constregtoCA($form) {
	$data = array(
					'meta' => array(
									'purpose' => 'userreg'),
					'userinfo' => $form
	);
	return $data;
}
