<?php

	require_once 'NotORM.php';
	require_once 'Slim/Slim.php';
	require 'Slim/Middleware.php';
	
	\Slim\Slim::registerAutoloader();
	
	// **** For Develpoment ****
	$pdo = new PDO('mysql:dbname=ArbourviewLocal;host=localhost', 'root', 'root');

	// **** For Production ****
		//$pdo = new PDO('mysql:dbname=Arbourview;host=localhost', 'visitor', 'myN2652N!!');

		// or until I get the correct permissions set up use the below

		// $pdo = new PDO('mysql:dbname=Arbourview;host=localhost', 'adminMike', 'Van16jaxon');


	$db = new NotORM($pdo);
	
	$app = new Slim\Slim();
	
	$app->get('/gallery', function() use ($app, $db){
	
		$data = array();
		
		foreach($db->gallery()->order('OrderNumber asc') as $gallery){
			$data[] =  array(
				'ImageID' 			=>	$gallery['ImageID'],
				'ImageName' 		=> 	$gallery['ImageName'],
				'ImageOrderNumber' 	=> 	$gallery['OrderNumber'],
				'Description'		=> 	$gallery['Description'],
				'IsFeatured'		=>	$gallery['IsFeatured']
			);
		}
		
		$app->response()->header('Content-Type', 'application/json');
		echo json_encode($data);	
	});
	$app->run();
	
?>
