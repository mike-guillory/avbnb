var correcting = false;

function validate(){

	var errors = null;
	var arriving = $('#arrivalInput').val();
	var departing = $('#departureInput').val();
	var guests = $('#numberOfGuests').val();
	var rooms = $('#numberOfRooms').val();
	var firstName = $('#firstName').val();
	var lastName = $('#lastName').val();
	var phone = $('#phone').val();
	var email = $('#email').val();		

	if(!arriving){
		alertColor($('label[for=arrival]'));
		errors = 1;
	}

	if(!departing){
		alertColor($('label[for=departure]'));
		errors = 1;
	}

	if(guests == 0){
		alertColor($('label[for=numberOfGuests]'));
		errors = 1;
	}

	if(rooms == 0){
		alertColor($('label[for=numberOfRooms]'));
		errors = 1;
	}

	if(!firstName){
		alertColor($('label[for=firstName]'));
		errors = 1;
	}

	if(!lastName){
		alertColor($('label[for=lastName]'));
		errors = 1;
	}

	if(!phone){
		alertColor($('label[for=phone]'));
		errors = 1;
	}
	else{

		var phoneValid = validatePhone(phone);

		if(!phoneValid){
			return;
		}
	}

	if(!email){
		alertColor($('label[for=email]'));
		errors = 1;
	}
	else{

		var emailValid = validateEmail();

		if(!emailValid){
			return;
		}
	}


	if(errors){

		errors = "Fields in red are required.";
		alert(errors);
		correcting = true;
	}
	else{

		submitReservation();
	}

	
}

function alertColor(theLabel){
	theLabel.css('color', 'red');
}

	
$(function(){

    $('#captchaPage').fadeIn(300);

	$('input[type!=button]').focus(function(){

		if(correcting == true){

			$('label[for=' + this.id + ']').css('color', '#13462d');
		}
		
	});

	$('select').focus(function(){

		if(correcting == true){

			$('label[for=' + this.id + ']').css('color', '#13462d');
		}
		
	});

});

$(window).load(function(){ // http://stackoverflow.com/questions/17980061/how-to-change-phone-number-format-in-input-as-you-type

	var phones = [{ "mask": "(###) ###-####"}];
    $('#phone').inputmask({ 
        mask: phones, 
        greedy: false, 
        definitions: { '#': { validator: "[0-9]", cardinality: 1}} });
});

$('#email').focusout(function(){

	validateEmail();
});

function validateEmail(){

	// http://stackoverflow.com/questions/3663968/how-to-validate-email-in-jquery
	var userEmail = $('#email').val();

	var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
	if (testEmail.test(userEmail))
	    return true;
	else
	    alert("Please enter a valid email address.");
}

function validatePhone(phone){ // adapted from http://stackoverflow.com/questions/19840301/jquery-to-validate-phone-number

    var filter = /\([0-9]{3}\)\s[0-9]{3}\-[0-9]{4}/;    // http://stackoverflow.com/questions/16850552/jquery-validate-phone-number-input-with-the-igorescobar-jquery-mask-plugin
    if (filter.test(phone)) {
        return true;
    }
    else {
        alert("Please enter a valid phone number.");
    }
}