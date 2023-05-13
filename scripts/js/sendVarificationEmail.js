function emailGuest(){

	// var n = document.getElementById("name").value;
	// var gmo = document.getElementById("guestMiusOne").value;
	// var nn = document.getElementById("numberOfNights").value;
	// var a = document.getElementById("arriving").value;
	// var d = document.getElementById("departing").value;
	// var r = document.getElementById("yourRequest").value;
	// var p = document.getElementById("phone").value;
	// var e = document.getElementById("email").value;
	
	$.ajax(
	{
		url:		"../scripts/php/sendVarificationEmail.php",
		data:       "emailText=" + emailText, 
		//data:		"arriving=" + a + "&departing=" + d + "&numberOfNights=" + nn + "&name=" + n + "&phone=" + p + "&email=" + e + "&yourRequest=" + r + "&guestMiusOne=" + gmo,
		type:		"POST",
		context:	$("#content-right"),
		success:	function(data)
					{
						$(this).html(data);
					}
	});	
}