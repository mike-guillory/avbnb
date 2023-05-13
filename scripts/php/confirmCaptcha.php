<?php

	$gresponse = $_POST["g-recaptcha-response"];

	$content = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdUwwETAAAAAH_UtTQ6uFH_NvB6nYTXBh1t1-Go&response=". $gresponse);
	
	$json = json_decode($content);

	$person = $json->success;

	if($person == 'true'){

		session_start();
		$_SESSION['person'] = '4rtIke87DFtejs';
		
		$person = true;

		echo $person;

	}
	else{

		$person = false;

		echo $person;

	}
?>