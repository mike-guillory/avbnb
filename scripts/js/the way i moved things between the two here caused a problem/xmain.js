// $.ajaxSetup ({
//     cache: false
// });

var today = new Date();
var month = today.getMonth();
var year = today.getFullYear();

$(document).ready(function(){

	var currentPage = location.pathname.split('/').slice(-1)[0];
	$("a[href='"+currentPage+"']").addClass("current").attr("id", "current");

	// Keep menu link for current page highlighted
	$('li > a').hover(function(){
		if($(this).not('btn-reservations'))
		{
			$('#current').toggleClass('current');
		}	
	});
});

// This causes check boxes, that are grouped by a common name,
// to behave like radio buttons (you can only select one).
// The check boxes also have the class "radio" to distinguish
// them from any other checkouts on the page.
// I go this from bPratik here: http://stackoverflow.com/questions/9709209/html-select-only-one-checkbox-in-a-group.
function selectOnlyOne(){
	
	$("input:checkbox.radio").click(function() {
    
    	if ($(this).is(":checked")) {
        	var group = "input:checkbox[name='" + $(this).attr("name") + "']";
        	$(group).prop("checked", false);
        	$(this).prop("checked", true);
    	}
    	else {
        	$(this).prop("checked", false);
    	}
	});
}



// function displayAvailability(){
	
// 	var xy = document.getElementById("selectedYear").selectedIndex;
//     var y = document.getElementById("selectedYear").getElementsByTagName("option")[xy].value;
	
// 	var xm = document.getElementById("selectedMonth").selectedIndex;
//     var m = document.getElementById("selectedMonth").getElementsByTagName("option")[xm].value;
	
// 	//alert(y + " " + m);
	
// 	if(window.XMLHttpRequest){
// 		xmlhttp = new XMLHttpRequest();
// 	}
// 	else{
// 		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
// 	}
		
// 	xmlhttp.onreadystatechange = function(){
// 		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
// 			document.getElementById("reservations").innerHTML = xmlhttp.responseText;
// 		}
// 		else
// 		{
// 			document.getElementById("reservations").innerHTML = xmlhttp.status;
// 		}
// 	}
	
// 	var daysArray = "";
// 	for(var i = 0; i < selectedDates.length; i++)
// 	{
// 		daysArray += "&days[]=" + selectedDates[i] + " +"; 	 
// 	}
// 	xmlhttp.open("GET", "scripts/php/getAvailability.php?year=" + y + "&month=" + m + daysArray, true);
		
// 	xmlhttp.send();
// }


