<?php

function checkclientaddr($clientaddr) {	
	if (empty($clientaddr->CA->main)) {
		return false;
	}
	if (empty($clientaddr->SI->main)) {
		return false;
	}
	return true;
}

$app->get('/client/check', function () {

	
	/*
	if (checkclientaddr($clientaddr)) {
		echo "Address complete";
	}
	else echo "Address not complete";
	*/
	
	header('Content-Type: application/json');
	echo json_encode($clientaddr);
});
