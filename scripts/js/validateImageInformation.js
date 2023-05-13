$(function(){

	// Display or hide Image File input error message.
	$('input[name="userfile"]').change(function(){
		if($(this).val())
		{
			$('.uploadImageErrors p:contains("The Choose File field is required")').fadeOut(200);
		}
		else
		{
			$('.uploadImageErrors p:contains("The Choose File field is required")').fadeIn(200);
		}
		

	});

	// Display or hide Image Number input error message.
	$('#ordNum').focusin(function(){
		$('.uploadImageErrors p:contains("The Image Number field is required")').fadeOut(200);
		$('.uploadImageErrors p:contains("The Image Number must be a number.")').fadeOut(200);
	});

	$('#ordNum').focusout(function(){
		if(!$(this).val())
		{
			$('.uploadImageErrors p:contains("The Image Number field is required")').fadeIn(200);
			$('.uploadImageErrors p:contains("The Image Number must be a number.")').fadeIn(200);
		};
		if(!$.isNumeric($(this).val()))
		{
			$('.uploadImageErrors p:contains("The Image Number must be a number.")').fadeIn(200);
		}
	});

});

function validate()
{
	var userfile = $('input[name="userfile"]').val();
	var imageNumber = $('#ordNum').val();

	if(!userfileError || !imageNumber)
	{
		if(!userfile)
		{
			$('#userfileError').css({'color': '#f00', 'display': 'block'});
		}

		if(!imageNumber)
		{
			$('#imageNumberError').css({'color': '#f00', 'display': 'block'});
		}
	}
	else{
		window.location = "http://localhost/Arbourview/avbnb/manageGallery/uploadImage";
	}

	
}
