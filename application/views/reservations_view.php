<script>
  // (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  // (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  // m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  // })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  // ga('create', 'UA-54438409-1', 'auto');
  // ga('send', 'pageview');

</script>
	<div class="tourView">
		<div class="tourBackGround">
			<div class="tourFrame">
			<div class="tourDiv">
					<h2>This Business is no Longer Operating</h2><br><br>
					<hr style="height: 3px; margin-bottom: 40px; background-color: white;">
					<p>The calendar on the reservations page is constructed with custom Javascript that I 
						wrote as well as a little bit of borrowed js for date formatting. The current date 
						is obtained server-side to guard against dates improperly set on the visitor’s 
						computer. The selectable years change automatically on the first day of the year.<br/><br/>
						When the B&#38B was in business the Submit Reservation Request button triggered a request 
						confirmation email to the guest and a reservation request email to the B&#38B owner. Currently, 
						for the purpose of demonstration, both emails will be sent to the address entered into the 
						E-Mail field.</p>
					<div class="buttonDiv">
						<button onclick="fadeOut()" autofocus>Close</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-8 column col-xs-12 column calendar-and-guest-info" id="content-right">

	<h1 class="centered reservation-heading">Request Your Reservation</h1>

	<div class="col-sm-6 calendar-container">
		<div class="calendar">
			<h2 id="displayMonth"></h2>
				<table id="days">
					<tr>										
						<th>Sun</th>							
						<th>Mon</th>							
						<th>Tue</th>							
						<th>Wed</th>							
						<th>Thu</th>							
						<th>Fri</th>							
						<th>Sat</th>							
					</tr>
				</table>
				<table id="calendar">
				</table>			
		</div><br>
		<div class="col-sm-12 select-month" id="selectMonth">
				
			<select name="selectedMonth" id="selectedMonth" onchange="displayMonth()"></select>
			<select name="selectedYear" id="selectedYear" onchange="populateMonthSelectList()"></select>
				
		</div>	
	</div>
			
	<div class="col-sm-6 policies" id="reservationPolicies">
		<h2 class="policies-heading">Policies</h2>
		<hr>
		<h4>Check-In/Check-out</h4>
		<p>Please check-in by 5pm and check-out by 11am.</p>
		<h4>Cancellation</h4>
		<p>Cancellations are accepted before arrival, however, the $25.00 deposit will not be returned.</p>
		<hr>
	</div>	
			
	<div class="col-sm-12 column guest-information">
		<p class="stay-length" style="font-size: 2em" id="numberOfNights">Please select your arrival date</p>
		<div class="stay-length"><label for="arrival">Arrive: </label>&nbsp&nbsp<p style="height: 16px; display: inline" id="arrival" name="arrival"></p></div><br>
		<div class="stay-length"><label for="departure">Depart: </label>&nbsp&nbsp<p style="height: 16px; display: inline" id="departure" name="departure"></p></div><br>
		<div class="col-sm-4" style="padding: 15px 0 0 0">
		<label for="numberOfGuests">Number of Guests: </label>
			<select id="numberOfGuests" name="numberOfGuests">
				<option value="0"></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
			</select><br><br>
		<label for="numberOfRooms">Number of Rooms: </label>
			<select id="numberOfRooms" name="numberOfRooms">
				<option value="0"></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
			</select><br><br>
		</div>
		<div class="col-sm-8">
			<label for="request">Special Requests</label><br>
			<textarea class="special-requests" rows="3" cols="50" id="request" name="request" style="resize: none" placeholder="Such as what you would like for breakfast, etc..."></textarea><br><br>
		</div>
		<div class="col-sm-12" style="padding-left: 0">
			<div class="reservationInformationContainter">
				<p class="reservationInformation"><label for="firstName">First Name:</label><input type="text" id="firstName" name="firstName" /></p>
				<p class="reservationInformation"><label for="lastName">Last Name:</label><input type="text" id="lastName" name="lastName" /></p>
			</div>
			<div class="reservationInformationContainter">
				<p class="reservationInformation"><label for="phone">Phone:</label><input type="tel" id="phone" name="phone" /></p>
				<p class="reservationInformation"><label for="email">E-Mail:</label><input type="email" id="email" name="email" /></p>
			</div>
			<p><input type="button" value="Submit Reservation Request" onclick="validate()"></p>
		</div>
		<input type="hidden" id="arrivalInput" name="arrivingInput">
		<input type="hidden" id="departureInput" name="departingInput">
		<input type="hidden" id="numberOfNightsInput" name="numberOfNightsInput">
		<input type="hidden" id="numberOfRoomsInput" name="numberOfRoomsInput">
		<input type="hidden" id="thisDayInput" value="<?php echo($date['mday']); ?>">
		<input type="hidden" id="thisYearInput" value="<?php echo($date['year']); ?>">
		<input type="hidden" id="thisMonthInput" value="<?php echo($date['mon']); ?>">

	</div>

</div>
	<link rel="stylesheet" type="text/css" href="css/lightbox.css" />
	<link rel="stylesheet" type="text/css" href="css/calendar.css" />
	<script src="scripts/js/lib/jquery-1.11.0.min.js"></script>
	<script src="scripts/js/lib/jquery.cycle.lite-min.js"></script>
	<script src="scripts/js/lib/slideshow.js"></script>
	<script src="scripts/js/main.js"></script>
	<script src="scripts/js/models.js"></script>
	<script src="scripts/js/views.js"></script>
	<!-- This is here so it doesn't effect the Gallery page. -->
	<script src="scripts/js/calendar.js"></script>
	<script src="scripts/js/reservations.js"></script>
	<script src="scripts/js/sendVarificationEmail.js"></script>
	<script src="scripts/js/progressIndicator.js"></script>
	<script src="scripts/js/validateReservation.js"></script>
	<script src="scripts/js/lib/inputmask.copy.js"></script>
