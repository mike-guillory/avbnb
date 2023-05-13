$(document).ready(function(){
	$('.image-slideshow div img').css('display', 'block');
	$('.image-slideshow').cycle({
		timeout: 1000,
		speed: 5000,
		pause: 0	
	});

	$('.comment-slideshow').cycle({
		timeout: 10000,
		pause: 0,
		after: onAfter
	});

// http://forum.jquery.com/topic/jquery-cycle-auto-height
function onAfter(curr, next, opts, fwd) {
  var $ht = $(this).height();
  //set the container's height to that of the current slide
  $(this).parent().animate({height: $ht});
}
	
/* 	$('a.image-container').lightbox({
		fixedNavigation: true
		}); */
});

/* function mainContent(){
	
	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}
	else{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
	}
		
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
			document.getElementById("main").innerHTML = xmlhttp.responseText;
		}
		else
		{
			document.getElementById("main").innerHTML = xmlhttp.status;
		}
	}
	xmlhttp.open("GET", "main.php", true);
	xmlhttp.send();

}; */
