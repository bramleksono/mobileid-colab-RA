<?php

$app->get('/register', function () use($app,$twig) {
	$username = 'Bramanto Leksono';
	
	$content = '	<div class="identity form">
					  <h2>Form Pendaftaran Pemilik Identitas</h2>
					  <form class="form-horizontal" action="register" method="post" enctype="multipart/form-data">
						<div class="form-group">
						  <label class="control-label col-sm-2">PIN</label>
						  <div class="col-sm-10">
							<input type="password" class="form-control" name="pin" placeholder="PIN">
						  </div>
						</div>
						<div class="form-group">
						  <label class="control-label col-sm-2">PIN (ulangi)</label>
						  <div class="col-sm-10">
							<input type="password" class="form-control" name="pin2" placeholder="Masukkan PIN yang sama">
						  </div>
						</div>
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
						<ol class="breadcrumb">Masukkan file gambar tandatangan <input type="file" name="signaturePicture"></ol>			
						<div class="form-group">        
						  <div class="col-sm-offset-2 col-sm-10">
							<button type="submit" class="btn btn-primary">Submit</button>
						  </div>
						</div>
					  </form>
					</div>                
				';
	
	$display=array(
	    'pagetitle' => 'Menu Pendaftaran Pemilik Identitas - MobileID RA',
	    'heading' => 'Petunjuk',
	    'subheading' => 'Halaman pendaftaran pemilik identitas (baru dan lama)',
	    'content' => $content,
	    'username' => $username,
		'license' => 'Aplikasi RA - Mobile ID',
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
	
	echo $twig->render('home.tmpl',$display);
	
});

$app->post('/register/', function () use ($app) {
	//get address
	global $CAuserreg;
	$idnumber = $app->request()->post("nik");
	
	$form= array(
			'pin' => $app->request()->post("pin"),
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
	
	//check if password equal
	if ($app->request()->post("pin") != $app->request()->post("pin2")) {
		$error = "PIN tidak sama. ";
	}
	
	//check if empty field exist
	foreach ($form as $field) {
		if (empty($field)) {
			$error = "Semua kolom harus diisi. ";
		}
	}
	
	//give message
	if (!empty($error)) {
		//TODO: using switch case for every error possibility
		$app->flash('error', $error);
	} else {
		
		//save signature to temp file
		
		$target_dir = "tmp/". $idnumber.".sig.jpg";
		$uploadOk=1;
		if (move_uploaded_file($_FILES["signaturePicture"]["tmp_name"], $target_dir)) {
			echo $message = "The file ". $target_dir . " has been uploaded.";
		} else {
			echo $message = "Sorry, there was an error uploading your file.";
		}

		//form valid
		//construct json
		$data = constregtoCA($form);
		$data["content"] = json_encode($data);
		
		//$CAuserreg = 'http://localhost:8080/user';
		
		//send form request to CA (save to database) and SI (create key pair)
		//$response = sendjson($data,$CAuserreg);
		$response = sendfile($target_dir,$data,$CAuserreg);
		
		if (empty($response)) {
			echo "Cannot send message to CA.";
		}
		var_dump($response);
		
		$app->flash('info', 'Pendaftaran berhasil.');
	}
	
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