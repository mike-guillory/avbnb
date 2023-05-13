function confirmCaptcha(response){

	var theResponse = response;

	$.ajax(
	{
		url: 		"../scripts/php/confirmCaptcha.php",
		data: 		"g-recaptcha-response=" + theResponse,
		type: 		"POST",
		success:    function(data)
					{

						if(data){

							$('#captchaPage').hide();
							document.getElementById('confirmedInput').value = "true";
						}
						else{

							$('#captchaPage').hide();
							alert("Sorry, there was a problem comunicating with the service that confirms that you are not a spaming robot. Please refresh the page and try again.");
							document.getElementById('confirmedInput').value = "false";
						}

					} 
	});
	
}

function cancelCaptcha(response){

	$('#captchaPage').hide();
	document.getElementById('confirmedInput').value = "false";
}