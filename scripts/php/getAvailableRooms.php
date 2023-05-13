<?php

	require ("connect.php");

	$arrival = $_GET["arrival"];
	$departure = $_GET["departure"];

	$querySQL = "SELECT udf_getRoomAvailabilty('$arrival', '$departure')";

	// udf_getRoomAvailabilty returns a single int. fetch_row  gets the only row that
	// will be returned
	$result = $mysqli->query($querySQL)->fetch_row();

	$numberOfAvailableRooms = $result[0];

	// FOR E-MAILING A RESERVATION NOTICE TO BRIAN. This will end up in another php
	//$subject = "This is a test";
	//$message = "This is the message.";
	// mail("michael_t53@hotmail.com", $subject, $message, "webdevmike101@gmail.com");
	//echo($html);

	echo($numberOfAvailableRooms);
?>


