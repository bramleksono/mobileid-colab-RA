<?php
//Aplikasi Mobile ID - RA untuk kolaborasi internet.

require 'vendor/autoload.php';

//twig init
$loader = new Twig_Loader_Filesystem('templates');
$twig = new Twig_Environment($loader);
//slim init
$app = new \Slim\Slim(array(
    'debug' => true
));

$app->add(new \Slim\Middleware\SessionCookie(array(
    'expires' => '20 minutes',
    'cookies.encrypt' => true,
    'cookies.secret_key' => 'ramobileid',
    'cookies.cipher' => MCRYPT_RIJNDAEL_256,
    'cookies.cipher_mode' => MCRYPT_MODE_CBC
)));

$app->get('/', function () use ($app) {
	//TODO: jika sudah login, redirect ke home
    $app->redirect('/login');
});

//Config
$addressfile = 'config/address.json';

//Lib
require 'lib/crypt.php';  // Handling cryptographic function
require 'lib/addstruct.php';  // Construct client address
require 'lib/sending.php';  // Handling sending http request function

//Routes
require 'routes/login.php';  // Handling login function
require 'routes/home.php';   // Handling main menu
require 'routes/status.php';   // Handling system status menu
require 'routes/register.php';   // Handling user registration
require 'routes/client.php'; // Handling CA & RA config


$app->run();
