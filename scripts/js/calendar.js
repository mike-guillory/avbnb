var arrivalDay = '';
var departureDay = '';
var arrivalDate = '';
var departureDate = '';
var selectedYear = '';
var selectedMonth = '';
var thisDay = document.getElementById('thisDayInput').value;
var thisYear = document.getElementById('thisYearInput').value;
var thisMonth = document.getElementById('thisMonthInput').value;
var arrivalHasValue = false;
var departureHasValue = false;

$(document).ready(function(){

	$('label[for=arrival]').mouseover(function(){

		if(document.getElementById('arrival').innerHTML == ""){

			document.getElementById('arrival').style.color = '#ff0000';
			document.getElementById('arrival').innerHTML = "Select the date from the calendar above.";
		}
		else{

			arrivalHasValue = true;
		}
	});

	$('label[for=arrival]').mouseout(function(){

		if(arrivalHasValue == false){

			document.getElementById('arrival').style.color = '#13462d';
			document.getElementById('arrival').innerHTML = "";
		};
	});	

	$('label[for=departure]').mouseover(function(){

		if(document.getElementById('departure').innerHTML == ""){

			document.getElementById('departure').style.color = '#ff0000';
			document.getElementById('departure').innerHTML = "Select the date from the calandar above.";
		}
		else{

			departureHasValue = true;
		}
	});

	$('label[for=departure]').mouseout(function(){

		if(departureHasValue == false){

			document.getElementById('departure').style.color = '#13462d';
			document.getElementById('departure').innerHTML = "";
		};
	});	

	$('#numberOfRooms').change(function(){

		var rooms = $('#numberOfRooms option:selected').val();

		var r = (rooms == 1) ? " room" : " rooms";

		var requesting = rooms + r;

		document.getElementById('numberOfRoomsInput').value = requesting;

		var nor = $('#numberOfRoomsInput').val();		
	});

});

function displayMonth(){

	selectedYear = document.getElementById('selectedYear').value;
	selectedMonth = parseInt(document.getElementById('selectedMonth').value) + 1;

	displayMonthName = getMonthName(selectedMonth - 1);

	document.getElementById("displayMonth").innerHTML = displayMonthName;

	var numberOfDays = getDaysInMonth(selectedMonth, selectedYear);

	var f = new Date(selectedYear, (selectedMonth - 1), 1);
	var firstDayOfMonth = f.getDay();

	var calendar = "";
			
	var i = 0;
	var dw = 0;
	var date = 1;
	var go = false;
	
	while(i < numberOfDays + firstDayOfMonth)
	{
		calendar = calendar + "<tr>";
	
		while(dw <= 6 && i < numberOfDays + firstDayOfMonth)
		{		
			if(firstDayOfMonth == i || go)
			{
				if(date < thisDay && selectedMonth == thisMonth && selectedYear == thisYear)
				{
					calendar = calendar + "<td class='past-date'>" + date + "</td>";
					date++;
					go = true;
				}
				else
				{
					calendar = calendar + "<td class='date-cell' onclick='highlight(this)'>" + date + "</td>";
					date++;
					go = true;
				}
			}
			else if(firstDayOfMonth > i)
			{
				calendar = calendar + "<td></td>";
			}
			
			i++;
			dw++;
		}
		
		calendar = calendar + "</tr>";
	
		dw = 0;
	}
		
	document.getElementById("calendar").innerHTML = calendar;
}

function getMonthName(m){

	var month = "";

	switch(m){

		case 0: month = "January";
				break;
		case 1: month = "February";
				break;
		case 2: month = "March";
				break;
		case 3: month = "April";
				break;
		case 4: month = "May";
				break;
		case 5: month = "June";
				break;
		case 6: month = "July";
				break;
		case 7: month = "August";
				break;
		case 8: month = "September";
				break;
		case 9: month = "October";
				break;
		case 10: month = "November";
				break;
		case 11: month = "December";
				break;
	};

	return month;
}

function getDaysInMonth(month, year) {

	// day 0 of a month is the last day of the previous month
	// so this gives us the number of days in this month 
    return new Date(year, month, 0).getDate();
}	

function highlight(element){ // Also sets arrival and departure dates.

	if(!arrivalDate)
	{
		arrivalDay = element.innerHTML;

		if(arrivalDay == thisDay && selectedMonth == thisMonth && selectedYear == thisYear)
		{
			alert("Please call if you would like to make a reservation for today.");
			return;
		}

		
		arrivalDate = new Date(selectedYear, selectedMonth - 1, arrivalDay);

		if(departureDate && departureDate < arrivalDate)
		{
			alert("The Arrival Date must be earlier than the Departure Date.");
			arrivalDay = "";
			arrivalDate = "";
			arrivalHasValue = false;
			return;
		}

		var ad = dateFormat(arrivalDate, "dddd, mmmm dS, yyyy");

		document.getElementById("arrival").innerHTML = ad + "  " + "<img class='btnEdit' src='img/btnEdit5.png' style='height: 16px; margin: -4px 0 0 0' onclick='editArrivalDate()'>";
		document.getElementById("arrivalInput").value = ad;
		$("label[for=arrival").css('color', '#13462d');
		arrivalHasValue = true;

		if(!departureDate)
		{
			document.getElementById("numberOfNights").innerHTML = "Please select your departure date";
		}
		else
		{
			document.getElementById("numberOfNights").innerHTML = " ";
		}
	}
	else if (!departureDate)
	{
		departureDay = element.innerHTML;
		departureDate = new Date(selectedYear, selectedMonth - 1, departureDay)

		if(arrivalDate && departureDate < arrivalDate)
		{
			alert("The Departure Date must be later than the Arrival Date.");
			departureDay = "";
			departureDate = "";
			departureHasValue = false;
			return;
		}

		var dd = dateFormat(departureDate, "dddd, mmmm dS, yyyy");

		document.getElementById("departure").innerHTML = dd + "  " + "<img class='btnEdit' src='img/btnEdit5.png' style='height: 16px; margin: -4px 0 0 0' onclick='editDepartureDate()'>";
		document.getElementById("departureInput").value = dd;
		document.getElementById("numberOfNights").innerHTML = " ";
		$("label[for=departure").css('color', '#13462d');
		departureHasValue = true;
	}
	if(departureDate)
	{
		displayNumberOfNights();
	}
}

function lengthOfStay(){

}

// function selectDates(element){


// 	selectedDates.push(element.innerHTML);
// 	selectedDates.sort(function(a, b){return a-b});
// 	displayNumberOfNights();
// }

// function deselectDates(element){

// 	selectedDates.splice(selectedDates.indexOf(element.innerHTML), 1);
// 	displayNumberOfNights();
// }

function editArrivalDate(){

	arrivalDay = "";
	arrivalDate = "";
	document.getElementById("arrival").innerHTML = "";
	document.getElementById("arrivalInput").value = "";
	document.getElementById("numberOfNights").innerHTML = "Please select your arrival date";
	arrivalHasValue = false;
}

function editDepartureDate(){

	departureDay = "";
	departureDate = "";
	document.getElementById("departure").innerHTML = "";
	document.getElementById("departureInput").value = "";
	departureHasValue = false;
	if(arrivalDate)
	{
		document.getElementById("numberOfNights").innerHTML = "Please select your departure date";
	}	
}

function displayNumberOfNights(){

	var count = (departureDate - arrivalDate) / 86400000;

	count = Math.round(count);

	var n = ((count > 1 || count == 0) ? " nights" : " night");

	var stay = 'Staying for ' + count + n;

	document.getElementById('numberOfNights').innerHTML = stay;
	document.getElementById('numberOfNightsInput').value = stay;
}

// function getAvailableRooms(){


// 	var availableRoomsList = new RoomsAvailable(selectedYear, selectedMonth, arrivalDate, departureDate);
	
// 	var results = availableRoomsList.fetch({
		
// 		success: function(){
			
// 			var availableRoomsView = new AvailableRoomsView(results.responseJSON);
		
// 		}
// 	});
// };

// function getAvailableRooms(){
	
// 	// Format the date for SQL
//  	var arrival = dateFormat(arrivalDate, "yyyy-mm-dd");

//  	// Subtract 1 day from departure date because the guests will not need a room on that day
//  	departureDate.setDate(departureDate.getDate() - 1);
//  	// Format the date for SQL
// 	var departure = dateFormat(departureDate, "yyyy-mm-dd");

// 	if(window.XMLHttpRequest){
// 		xmlhttp = new XMLHttpRequest();
// 	}
// 	else{
// 		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
// 	}
		
// 	xmlhttp.onreadystatechange = function(){
// 		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
// 			document.getElementById("roomsAvailable").innerHTML = xmlhttp.responseText;
// 			$('.rooms-available').toggle();
// 			$('.reservation-form').toggle();
// 		}
// 		else
// 		{
// 			document.getElementById("roomsAvailable").innerHTML = xmlhttp.status;
// 		}													
// 	}														
// 	xmlhttp.open("GET", "scripts/php/getAvailableRooms.php?arrival=" + arrival + "&departure=" + departure, true);
// 	xmlhttp.send();											
// }

/*
 * Date Format 1.2.3
 * (c) 2007-2009 Steven Levithan <stevenlevithan.com>
 * MIT license
 *
 * Includes enhancements by Scott Trenda <scott.trenda.net>
 * and Kris Kowal <cixar.com/~kris.kowal/>
 *
 * Accepts a date, a mask, or a date and a mask.
 * Returns a formatted version of the given date.
 * The date defaults to the current date/time.
 * The mask defaults to dateFormat.masks.default.
 */

var dateFormat = function () {
	var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
		timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
		timezoneClip = /[^-+\dA-Z]/g,
		pad = function (val, len) {
			val = String(val);
			len = len || 2;
			while (val.length < len) val = "0" + val;
			return val;
		};

	// Regexes and supporting functions are cached through closure
	return function (date, mask, utc) {
		var dF = dateFormat;

		// You can't provide utc if you skip other args (use the "UTC:" mask prefix)
		if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
			mask = date;
			date = undefined;
		}

		// Passing date through Date applies Date.parse, if necessary
		date = date ? new Date(date) : new Date;
		if (isNaN(date)) throw SyntaxError("invalid date");

		mask = String(dF.masks[mask] || mask || dF.masks["default"]);

		// Allow setting the utc argument via the mask
		if (mask.slice(0, 4) == "UTC:") {
			mask = mask.slice(4);
			utc = true;
		}

		var	_ = utc ? "getUTC" : "get",
			d = date[_ + "Date"](),
			D = date[_ + "Day"](),
			m = date[_ + "Month"](),
			y = date[_ + "FullYear"](),
			H = date[_ + "Hours"](),
			M = date[_ + "Minutes"](),
			s = date[_ + "Seconds"](),
			L = date[_ + "Milliseconds"](),
			o = utc ? 0 : date.getTimezoneOffset(),
			flags = {
				d:    d,
				dd:   pad(d),
				ddd:  dF.i18n.dayNames[D],
				dddd: dF.i18n.dayNames[D + 7],
				m:    m + 1,
				mm:   pad(m + 1),
				mmm:  dF.i18n.monthNames[m],
				mmmm: dF.i18n.monthNames[m + 12],
				yy:   String(y).slice(2),
				yyyy: y,
				h:    H % 12 || 12,
				hh:   pad(H % 12 || 12),
				H:    H,
				HH:   pad(H),
				M:    M,
				MM:   pad(M),
				s:    s,
				ss:   pad(s),
				l:    pad(L, 3),
				L:    pad(L > 99 ? Math.round(L / 10) : L),
				t:    H < 12 ? "a"  : "p",
				tt:   H < 12 ? "am" : "pm",
				T:    H < 12 ? "A"  : "P",
				TT:   H < 12 ? "AM" : "PM",
				Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
				o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
				S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
			};

		return mask.replace(token, function ($0) {
			return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
		});
	};
}();

// Some common format strings
dateFormat.masks = {
	"default":      "ddd mmm dd yyyy HH:MM:ss",
	shortDate:      "m/d/yy",
	mediumDate:     "mmm d, yyyy",
	longDate:       "mmmm d, yyyy",
	fullDate:       "dddd, mmmm d, yyyy",
	shortTime:      "h:MM TT",
	mediumTime:     "h:MM:ss TT",
	longTime:       "h:MM:ss TT Z",
	isoDate:        "yyyy-mm-dd",
	isoTime:        "HH:MM:ss",
	isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
	isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
	dayNames: [
		"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
		"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
	],
	monthNames: [
		"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
		"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
	]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
	return dateFormat(this, mask, utc);
};




// function countDays(){

// 	var endYear = 1972;
// 	var startYear = 1971;
// 	var yearDifference = 0;
// 	var yearsLeft = 0;
// 	var endMonth = 0;
// 	var startMonth = 11;
// 	var endDay = 1;
// 	var startDay = 31;
// 	var dayCount = 0;

// 	if(endYear == startYear && endMonth == startMonth)
// 	{
// 		dayCount = endDay - startDay;
// 		alert("still " + dayCount);
// 	}
// 	else
// 	{
// 		i = endMonth;
// 		while(i > startMonth)
// 		{
// 			dayCount = dayCount + getDaysInMonth(i - 1, endYear);
// 			i--;
// 		}

// 		dayCount = dayCount + (endDay - 1);


// 		if(endYear != startYear)
// 		{
// 			yearDifference = endYear - startYear;
// 			yearsLeft = yearDifference;
// 			var i = 1;
// 			while(yearsLeft > 1)
// 			{
// 				var monthsLeftToCount = 12;
// 				while(monthsLeftToCount > 0)
// 				{
// 					y = getDaysInMonth(monthsLeftToCount, endYear - i);

// 					dayCount = dayCount + y;

// 					monthsLeftToCount--;

// 				}

// 				i++;
// 				yearsLeft--;			
// 			}

// 			var monthsLeftToCount = 12;
// 			i = startMonth + 1;
// 			while(i < monthsLeftToCount)
// 			{
// 				y = getDaysInMonth(monthsLeftToCount, endYear);

// 				dayCount = dayCount + y;

// 				monthsLeftToCount--;
// 			}
// 		}
			
// 		dayCount = dayCount  - startDay;
			
// 		var daysInFirstMonth = getDaysInMonth(startMonth + 1, startYear);
// 		if(daysInFirstMonth == startDay && dayCount == 0)
// 		{
// 			dayCount++;
// 		}

// 		alert("final " + dayCount);
// 	}
// }