function submitReservation(){

	// Commented out to disable CAPTCHA
	//var confirmed = document.getElementById('confirmedInput').value;

	//if(confirmed == 'true'){

		var a = document.getElementById("arrivalInput").value;
		var d = document.getElementById("departureInput").value;
		var nn = document.getElementById("numberOfNightsInput").value;
		var nr = document.getElementById("numberOfRoomsInput").value;
		var fn = document.getElementById("firstName").value;
		var ln = document.getElementById("lastName").value;
		var ph = document.getElementById("phone").value;
		var e = document.getElementById("email").value;
		var r = document.getElementById("request").value;
		var ng = document.getElementById("numberOfGuests").value;

		if(!r){

			r = "The guest has made no special requests.";
		}

		
		$.ajax(
		{
			url:		"reservations/emailReservationRequest",
			data:		"arriving=" + a + "&departing=" + d + "&numberOfNights=" + nn + "&firstName=" + fn + "&lastName=" + ln + "&phone=" + ph + "&email=" + e + "&request=" + r + "&numberOfGuests=" + ng + "&numberOfRooms=" + nr,
			type:		"POST",
			context:	$("#content-right"),
			success:	function(data)
						{
							$(this).html(data);
						}
		});	
	// }
	// else{

	// 	$('#captchapage').show();
	// }
}