<?php
	$server = "127.0.0.1";
	$user = "root";
	$password = "root";
	$database = "arbourviewreservations";
	
	mysqli_report(MYSQLI_REPORT_STRICT);

	try{

	 	$mysqli = new mysqli($server, $user, $password, $database);

	 	echo "Connected";

	}
	catch(Exception $e){

	 	echo $e->getMessage();
	}

?>