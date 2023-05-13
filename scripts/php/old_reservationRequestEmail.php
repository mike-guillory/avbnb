<?php

	$sent = "";
	$timeSent = "";
	$GLOBALS['$attempts'] = 1;
	

	send();

	function send(){

		$arriving = $_POST["arriving"];
		$departing = $_POST["departing"];
		$numberOfNights = $_POST["numberOfNights"];
		$name = $_POST["name"];
		//$firstName = $_POST["firstName"];
		//$lastName = $_POST["lastName"];
		$phone = $_POST["phone"];
		$email = $_POST["email"];
		$request = $_POST["request"];
		$numberOfGuests = $_POST["numberOfGuests"];
		$guestMiusOne = $numberOfGuests - 1;

		$ng = "guest";
		$ag = "guest";

		if($numberOfGuests > 1 ){
			$ng = "guests";
		}

		if($guestMiusOne > 1 || $guestMiusOne == 0){
			$ag = "guests";
		}

		if($request == "The guest has made no special requests."){

			$yourRequest = "You have made no special requests";
		}
		else{

			$yourRequest = "You have requested; ". $request;
		}

		date_default_timezone_set("America/Toronto");

		$GLOBALS['$timeSent'] = date("h:i:s a");

		// (Windows only) When PHP is talking to a SMTP server directly, 
		// if a full stop is found on the start of a line, it is removed. 
		// To counter-act this, replace these occurrences with a double dot.
		// Remove this line when uploaded to GoDaddy Linux server
		$text = str_replace("\n", "\n..", $text);

		// Email reservation request to Brian.
		$requestSubject = "Sent at ". $GLOBALS['$timeSent'];

		$requestMessage = "You've got another reservation request. \r\n". 
					"Arriving: ". $arriving. "\r\n". 
					"Departing: ". $departing. "\r\n". 
					$numberOfNights. " \r\n". 
					$numberOfGuests. " ". $ng. "\r\n".  
					"Special Request: ". $request. "\r\n". 
					"Name: ". $name. "\r\n".
					//$firstName. " ". $lastName. "\r\n".
					"Phone Number: ". $phone. "\r\n". 
					"Email address: ". $email;

		$requestMessage = wordwrap($requestMessage, 70, "\r\n");

		// Email varification to guest
		$varificationSubject = "Varification email";

		$varificationMessage = "Here are the details of your reservation request. \r\n". 
					"Arriving: ". $arriving. "\r\n". 
					"Departing: ". $departing. "\r\n". 
					$numberOfNights. " \r\n". 
					$numberOfGuests. " ". $ng. "\r\n".  
					"Special Request: ". $yourRequest. "\r\n". 
					"Name: ". $name. "\r\n".
					//$firstName. " ". $lastName. "\r\n".
					"Phone Number: ". $phone. "\r\n". 

		$varificationMessage = wordwrap($varificationMessage, 70, "\r\n");

		$GLOBALS['$sent'] = mail("michael_t53@hotmail.com", $requestSubject, $requestMessage, "webdevmike101@gmail.com");

		if($GLOBALS['$sent']){

			mail($email, $varificationSubject, $varificationMessage, "webdevmike101@gmail.com");

			$varification = '<div class="col-sm-8 column" id="content-right">

								<h4>Your reservation request has been sent</h4>'. 
								"It was sent in ". $GLOBALS['$attempts']. " tries.". 
								$name. " plus ". $guestMiusOne. " accompanying ". $ag. ".<br> ". 
								$numberOfNights. ".<br>".
								"Arriving on ". $arriving. ".<br>". 
								"Departing on ". $departing. ".<br>".
								$yourRequest. "<br>".
								"Your phone number is ". $phone. ".<br>".
								"You email address is ". $email. ".<br>".
								"An email with these details has been sent to your in-box.<br>".
								"Thank you. You will be contacted shortly.<br>".

							'</div>';

			echo($varification);
		}
		// if($GLOBALS['$sent'] == null || $GLOBALS['$sent'] == ""){
		// 	$GLOBALS['$sent'] = 0;
		// }

		if($GLOBALS['$sent'] < 1){

			for($x = 1; $x <= 3 && $GLOBALS['$sent'] < 1; $x++){

				$GLOBALS['$attempts']++;
				send();
			}
			if($GLOBALS['$sent'] < 1){
				echo("Not Sent ". " at ". $GLOBALS['$timeSent']);
			}
		}


	}	



		// else{

		// 	if($GLOBALS['$sent'] == null || $GLOBALS['$sent'] == ""){
		
		// 		$GLOBALS['$sent'] = 0;
		// 	}

		// 	echo("Not Sent ". $GLOBALS['$sent']. " at ". $GLOBALS['$timeSent']);

		// }


	// if($GLOBALS['$sent'] == null || $GLOBALS['$sent'] == ""){
	// 	$GLOBALS['$sent'] = 0;
	// }

	// if($GLOBALS['$sent'] < 1){

	// 	for($x = 1; $x <= 3; $x++){

	// 		if($GLOBALS['$sent'] < 1){

	// 			send();
	// 		}

	// 	}
	// 	if($GLOBALS['$sent'] == 1){

	// 		echo("Finnaly Sent ". $GLOBALS['$sent']. " at ". $GLOBALS['$timeSent']);

	// 	}
	// 	else{

	// 		if($GLOBALS['$sent'] == null || $GLOBALS['$sent'] == ""){
		
	// 			$GLOBALS['$sent'] = 0;
	// 		}

	// 		echo("Not Sent ". $GLOBALS['$sent']. " at ". $GLOBALS['$timeSent']);

	// 	}
		
	// }
	// else{

	// 	echo("Sent 	". $GLOBALS['$sent']. " at ". $GLOBALS['$timeSent']);

	// }

	
?>