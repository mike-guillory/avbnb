<?php
	
 	require ("connect_not_using.php");
	
 	$firstNight = $_POST["firstNight"];
	$lastNight = $_POST["lastNight"];
	$numberOfNights = $_POST["numberOfNights"];
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$request = $_POST["request"];
	$numberOfGuests = $_POST["numberOfGuests"];
	
	$insertSQL = "CALL usp_submitReservation('$firstName', '$lastName', 'NA', '$firstNight', '$lastNight', '$numberOfNights', '$numberOfGuests', '$request', '$phone', '$email', @ReservationID)";
	$selectSQL =  "SELECT @ReservationID";
	
	$mysqli->query($insertSQL);
	$outVar = $mysqli->query($selectSQL);
	
	$reservationID = mysqli_fetch_assoc($outVar)["@ReservationID"];
		
		
		
	//FOR E-MAILING A RESERVATION NOTICE TO BRIAN. This will end up in another php
	//$subject = "This is a test";
	//$message = "$reservationID";
	//mail("michael_t53@hotmail.com", $subject, $message, "webdevmike101@gmail.com");
	//echo($html);

	
	echo $reservationID;
	
	
	
	//$m = "In submit.php";
	//echo"<script type='text/javascript'>alert('$m');</script>";
	
	//echo"<script type='text/javascript'>console.log('$querySQL');</script>";
?>