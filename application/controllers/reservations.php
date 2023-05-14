<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

	class Reservations extends CI_Controller
	{
		public function index()
		{
			define('TITLE', "Make a Reservation&#44; Arbourview Bed and Breakfast");
			define('DESCRIPTION', "Request your reservation at the friendly, beautiful, quiet and comfortable Arbourview Bed and Breakfast in the Niagara Falls region.");
			
			$pageData['title'] = TITLE;
			$pageData['description'] = DESCRIPTION;
			$pageData['date'] = getDate();
			$this->load->view('header_view', $pageData);
			
			$this->load->model('Gallery_model');
			$imageData['images'] = $this->Gallery_model->getGallery();
			$this->load->model('Content_model');
			$imageData['price'] = $this->Content_model->getContent()->price;
			$this->load->view('left_column_view', $imageData);

			$this->load->view('reservations_view');
			$this->load->view('footer_view');
		}

		function emailReservationRequest()
		{ 	// Declares the reservation variables, checks that the user passed the human test,
			// and calls the function to send email to Brian

 			date_default_timezone_set("America/Toronto");

			$GLOBALS['requestSent'] = "";
			$GLOBALS['timeSent'] = date("h:i a");
			$GLOBALS['attempts'] = "";
			$GLOBALS['arriving'] = $_POST["arriving"];
			$GLOBALS['departing'] = $_POST["departing"];
			$GLOBALS['numberOfNights'] = $_POST["numberOfNights"];
			$GLOBALS['firstName'] = $_POST["firstName"];
			$GLOBALS['lastName'] = $_POST["lastName"];
			$GLOBALS['phone'] = $_POST["phone"];
			$GLOBALS['guestEmail'] = $_POST["email"];
			$GLOBALS['request'] = $_POST["request"];
			$GLOBALS['numberOfRooms'] = $_POST["numberOfRooms"];
			$GLOBALS['numberOfGuests'] = $_POST["numberOfGuests"];
			$GLOBALS['guestMiusOne'] = $GLOBALS['numberOfGuests'] - 1;
			$GLOBALS['briansEmail'] = "mike.guillory@credowebdev.com";
			//$GLOBALS['briansEmail'] = "bdorsey@bell.net";
			$GLOBALS['briansEmail'] = $_POST["email"];
			$GLOBALS['ng'] = "guest";
			$GLOBALS['ag'] = "guest";
			$GLOBALS['errorMsg'] = "";
			
			if($GLOBALS['numberOfGuests'] > 1 ){

				$GLOBALS['ng'] = "guests";
			}
			if($GLOBALS['guestMiusOne'] > 1 || $GLOBALS['guestMiusOne'] == 0){

				$GLOBALS['ag'] = "guests";
			}
			if($GLOBALS['request'] == "The guest has made no special requests."){

				$GLOBALS['yourRequest'] = "You have made no special requests.";
			}
			else{

				$GLOBALS['yourRequest'] = "Your Special Request: ". $GLOBALS['request'];
			}

			// Commented out to disable CAPTCHA
			//session_start();
			//if($_SESSION['person'] == '4rtIke87DFtejs')
			//{
				$this->_sendRequest();
			//}
			//else
			//{
				//$errorPage = '<div class="col-sm-12 column displayRequest" id="displayRequest">
									//<h3>There is a problem</h3>
								//</div>';

				//echo($errorPage);
			//}
		}
		
		function _sendRequest()
		{ 	// Builds the reservation request email for Brian, calls the function that sends the email,
		  	// and also calls the function to build an email with the details of the request for the guest

			$requestSubject = "Sent at ". $GLOBALS['timeSent'];

			$requestMessage = "You have another reservation request.". "\r\n". 
								"Arriving: ". $GLOBALS['arriving']. "\r\n". 
								"Departing: ". $GLOBALS['departing']. "\r\n". 
								$GLOBALS['numberOfNights']. "\r\n". 
								$GLOBALS['numberOfGuests']. " ". $GLOBALS['ng']. "\r\n". 
								$GLOBALS['numberOfRooms']. "\r\n". 
								"Special Request: ". $GLOBALS['request']. "\r\n". 
								"Name: ". $GLOBALS['firstName']. " ". $GLOBALS['lastName']. "\r\n".
								"Phone Number: ". $GLOBALS['phone']. "\r\n". 
								"Email address: ". $GLOBALS['guestEmail'];

			$requestMessage = wordwrap($requestMessage, 70, "\r\n");
			$requestSent = false;

			for($i = 1; $i <= 10 && !$requestSent; $i++){

				$requestSent = $this->_sendEmail($GLOBALS['briansEmail'], $requestSubject, $requestMessage);

				//$GLOBALS['attempts'] = $i;
			}

			if($requestSent){
		
				$this->_sendDetails();
			}
			else{

				echo $GLOBALS['errorMsg'];
				echo '<br><br><h3 style="margin: 0 auto; text-align: left">There seems to be a problem with the email system at the momment. Please contact us by phone at Home: (905) 937-5261 or Mobile: (905) 931-0844. We are sorry for the inconvenience';
			}
		}
		
		function _sendDetails()
		{	// Builds the email containing the details of the reservation request for the guest, calls the
		  	// function to send the email, and also calls the function that displays the details on the web page

			$varificationSubject = "Reservation Request Details";

			$varificationMessage = "Here are the details of your reservation request. \r\n". 
									"Arriving: ". $GLOBALS['arriving']. "\r\n". 
									"Departing: ". $GLOBALS['departing']. "\r\n". 
									$GLOBALS['numberOfNights']. "\r\n". 
									$GLOBALS['numberOfGuests']. " ". $GLOBALS['ng']. "\r\n".
									$GLOBALS['numberOfRooms']. "\r\n".  
									$GLOBALS['yourRequest']. "\r\n". 
									"Name: ". $GLOBALS['firstName']. " ". $GLOBALS['lastName']. "\r\n".
									"Phone Number: ". $GLOBALS['phone']. "\r\n";

			$varificationMessage = wordwrap($varificationMessage, 70, "\r\n");
			$detailsSent = 0;

			for($i = 1; $i <= 10 && $detailsSent != 1; $i++){

				$detailsSent = $this->_sendEmail($GLOBALS['guestEmail'], $varificationSubject, $varificationMessage);

			}

			$this->_displayRequest($detailsSent);		
		}
					
		function _displayRequest($detailsSent)
		{ 	// Displays the request details on the web page

			if($detailsSent){

				$detailsSent = "An email with these details has been sent to your in-box.<br>";

			}
			else{

				$detailsSent = "";
			}

			$request = '<div class="col-sm-12 column displayRequest" id="displayRequest">
							<h4>Your reservation request has been sent</h4>'. 
							// "It was sent in ". $GLOBALS['attempts']. " tries.". "<br>".
							"<p>". $GLOBALS['firstName']. " ". $GLOBALS['lastName']. " plus ". $GLOBALS['guestMiusOne']. " ". $GLOBALS['ag']. ".</p>". 
							"<p>". "Requesting ". $GLOBALS['numberOfRooms']. ".</p>".
							"<p>". $GLOBALS['numberOfNights']. ".</p>".
							"<p>". "Arriving on ". $GLOBALS['arriving']. ".</p>". 
							"<p>". "Departing on ". $GLOBALS['departing']. ".</p>".
							"<p>". $GLOBALS['yourRequest']. "</p>".
							"<p>". "We have your phone number as ". $GLOBALS['phone'].
							" and your email address as ". $GLOBALS['guestEmail']. ".</p>".
							"<p>". $detailsSent.
							"<p>". "Thank you. You will be contacted shortly.</p>".
						'</div>';

				echo($request);
		}

		function _sendEmail($to, $subject, $message)
		{	// Sends the emails to Brian and the guest
			
 			$avbnbEmail = 'mike.guillory@credowebdev.com';//'donotreply@briandorseymusic.com';


			$config = Array(
				'smtp_host' => 'smtp.hostinger.com',
				'smtp_port' => 465,
				'smtp_user' => $avbnbEmail,
				'smtp_pass' => ''
			);
/* 			$config = Array(
				'smtp_host' => 'smtp.gmail.com', //'mail.briandorseymusic.com',
				'smtp_port' => 25,
				'smtp_user' => $avbnbEmail,
				'smtp_pass' => ''
			); */
			
			

			$this->load->library('email', $config);
			$this->email->set_newline('\r\n');

			if($subject == "Reservation Request Details"){

				$this->email->from($avbnbEmail, 'Arbourview Bed and Breakfast');
			}
			else{

				$this->email->from($avbnbEmail, 'Reservation Request');
			}
			$this->email->to($to);
			$this->email->subject($subject);
			$this->email->message($message);

			if($this->email->send())
			{
				// $this->email->to("webdevmike101@gmail.com");
				// $this->email->subject($subject);
				// $this->email->message($message);
				// $this->email->send();
				return true;
			}
			else
			{
				$GLOBALS['errorMsg'] = show_error($this->email->print_debugger());
				return false;
				//show_error($this->email->print_debugger());
			}
		}
	}