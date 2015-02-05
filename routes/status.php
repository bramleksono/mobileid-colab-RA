<?php

$app->get('/status', function () use($twig) {
	$username = 'Bramanto Leksono';
	
	$content = '<div class="panel panel-default">
                  <div class="panel-heading"><h4>Status</h4></div>
                  <div class="panel-body">
                    
                    <small>CA</small>
                    <div class="progress">
                      <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100" style="width: 72%">
                        <span class="sr-only">72% Complete</span>
                      </div>
                    </div>
                    <small>RA</small>
                    <div class="progress">
                      <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                        <span class="sr-only">20% Complete</span>
                      </div>
                    </div>
                    <small>SI</small>
                    <div class="progress">
                      <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                        <span class="sr-only">80% Complete</span>
                      </div>
                    </div>

                  </div><!--/panel-body-->
              </div><!--/panel-->                     
				';
	
	$display=array(
	    'pagetitle' => 'Status Sistem - MobileID RA',
	    'heading' => 'Petunjuk',
	    'subheading' => 'Halaman ini menunjukkan status sistem',
	    'content' => $content,
	    'username' => $username,
		'license' => 'Aplikasi RA - Mobile ID',
		'year' => '2015',
		'author' => 'Bramanto Leksono',
	);
	echo $twig->render('home.tmpl',$display);
	
});
