<?php

require 'rb.php';
//R::setup();

R::setup('pgsql:host=localhost;dbname=mobileid',
        'postgres','tesaccount');

/*
$book = R::dispense( 'book' );
$book->title = 'Learn to Program';
$book->rating = 10;
$book['price'] = 29.99; //you can use array notation as well
$id = R::store( $book );
*/

$books = R::findAll( 'book' );
foreach ($books as $book) {
	echo $book->title.PHP_EOL;
}
