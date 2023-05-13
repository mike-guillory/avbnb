// http://www.willmaster.com/library/features/ajax-to-fill-div.php ///////////////////////////////////////////////////////////
// Version 1.1 of May 16, 2013
function RequestContent() {

	var url = 'scripts/php/featuredImages.php';
	var id = 'image-slideshow';

	var http;
	if (window.XMLHttpRequest) {
	   try { http = new XMLHttpRequest(); }
	   catch(e) {}
	   } 
	else if (window.ActiveXObject) {
	   try { http = new ActiveXObject("Msxml2.XMLHTTP"); }
	   catch(e) {
		  try { http = new ActiveXObject("Microsoft.XMLHTTP"); } 
		  catch(e) {}
		  }
	   }
	if(! http) {
	   alert('\n\nSorry, unable to open a connection to the server.');
	   return false;
	   }
	http.onreadystatechange = function() { PublishContent(http,id); };
	http.open('GET',url,true);
	http.send('');
}

function PublishContent(content,id) {
	try {
	   if (content.readyState == 4) {
		  if(content.status == 200) { document.getElementById(id).innerHTML=content.responseText; }
		  else { alert('\n\nContent request error, status code:\n'+content.status+' '+content.statusText); }
		  }
	   }
	catch(error) { alert('Error: '+error.name+' -- '+error.message); }
}