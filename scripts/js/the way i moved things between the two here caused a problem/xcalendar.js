(function(){

	populateYearSelectList();
	populateMonthSelectList();
	
})();

// var selectedDates = [];
var arrivalDay = '';
var departureDay = '';
var arrivalDate = '';
var departureDate = '';
var selectedYear = '';
var selectedMonth = '';
var myDate = new Date();
var thisDay = myDate.getDate();
var thisYear = myDate.getFullYear();
var thisMonth = myDate.getMonth() + 1;

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

function populateYearSelectList(){
	
	var yearSelectList = document.getElementById("selectedYear");
	
	var i = 0;
	while(i < 2)
	{	
		var yearOption = document.createElement("option");
		yearOption.text = year + i;
		yearOption.value = year + i;
		yearSelectList.add(yearOption, yearSelectList[i]);	
		i++;
	}
}

function populateMonthSelectList(){

	$("#selectedMonth").empty();
	var i = month;
	var m;
	var ii = 0;
	var selectedYear = $('#selectedYear').find(":selected").text();
				
	if(selectedYear > year)
	{	
		i = 0;
		while(i < 12)
		{
			m = i;
			addMonthOption(m, ii);
			i++;
			ii++;
		}
	}
	else
	{
		while(i < 12)
		{
			m = i;
			addMonthOption(m, ii);
			i++;
			ii++;
		}
	}
	
	displayMonth();
}

function addMonthOption(m, ii){
	
		var monthSelectList = document.getElementById("selectedMonth");
		var monthOption = document.createElement("option");
	
		switch(m){
		
			case 0: monthOption.text = "January";
					monthOption.value = 0;
					break;
			case 1: monthOption.text = "February";
					monthOption.value = 1;
					break;
			case 2: monthOption.text = "March";
					monthOption.value = 2;
					break;
			case 3: monthOption.text = "April";
					monthOption.value = 3;
					break;
			case 4: monthOption.text = "May";
					monthOption.value = 4;
					break;
			case 5: monthOption.text = "June";
					monthOption.value = 5;
					break;
			case 6: monthOption.text = "July";
					monthOption.value = 6;
					break;
			case 7: monthOption.text = "August";
					monthOption.value = 7;
					break;
			case 8: monthOption.text = "September";
					monthOption.value = 8;
					break;
			case 9: monthOption.text = "October";
					monthOption.value = 9;
					break;
			case 10: monthOption.text = "November";
					monthOption.value = 10;
					break;
			case 11: monthOption.text = "December";
					monthOption.value = 11;
					break;
		};
		
		monthSelectList.add(monthOption, monthSelectList[ii]);	
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

function highlight(element){

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
			return;
		}

		// Format the arrival date for display on the page.
		var ad = dateFormat(arrivalDate, "dddd, mmmm dS, yyyy");
		// Format the arrival date for hidden form input.
		var adInput = dateFormat(arrivalDate, "yyyy-mm-dd");

		document.getElementById("arrival").innerHTML = ad + "  " + "<img class='btnEdit' src='../img/btnEdit4.png' style="height: 16px" onclick='editArrivalDate()'>";
		document.getElementById("arrivalInput").value = adInput;
		
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
			return;
		}

		// Format the departure date for display on the page.
		var dd = dateFormat(departureDate, "dddd, mmmm dS, yyyy");
		// Format the departure date for hidden form input.
		var ddInput = dateFormat(departureDate, "yyyy-mm-dd");

		document.getElementById("departure").innerHTML = dd + "  " + "<img class='btnEdit' src='../img/btnEdit4.png' style="height: 16px" onclick='editDepartureDate()'>";
		document.getElementById("departureInput").value = ddInput;
		
		document.getElementById("numberOfNights").innerHTML = " ";
	}
	if(departureDate)
	{
		displayNumberOfNights();
	}
}

function lengthOfStay(){

}

function editArrivalDate(){

	arrivalDay = "";
	arrivalDate = "";
	document.getElementById("arrival").innerHTML = ""; //"<img class='btnEdit' src='../img/btnEdit4.png' style='height:12px'>";
	document.getElementById("numberOfNights").innerHTML = "Please select your arrival date";
}

function editDepartureDate(){

	departureDay = "";
	departureDate = "";
	document.getElementById("departure").innerHTML = ""; //"<img class='btnEdit' src='../img/btnEdit4.png' style='height:12px'>";
	if(arrivalDate)
	{
		document.getElementById("numberOfNights").innerHTML = "Please select your departure date";
	}	
}

function displayNumberOfNights(){

	var count = (departureDate - arrivalDate) / 86400000;

	var n = ((count > 1 || count == 0) ? " nights." : " night.");

	var stay = 'Staying for ' + count + n;

	document.getElementById('numberOfNights').innerHTML = stay;
	document.getElementById('numberOfNightsInput').value = count;
}

function getRoomAvailability(){
	
	var roomsAvailable = false;

	// Format the date for SQL
 	var arrival = dateFormat(arrivalDate, "yyyy-mm-dd");

 	// Subtract 1 day from departure date because the guests will not need a room on that day
 	departureDate.setDate(departureDate.getDate() - 1);
 	// Format the date for SQL
	var departure = dateFormat(departureDate, "yyyy-mm-dd");

	if(window.XMLHttpRequest){
		xmlhttp = new XMLHttpRequest();
	}
	else{
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
	}
		
	xmlhttp.onreadystatechange = function(){
		if(xmlhttp.readyState == 4 && xmlhttp.status == 200){

			if(xmlhttp.responseText > 0)
			{
				roomsAvailable = true;
			}
			alert(roomsAvailable);
		}
		else
		{
			console.log(xmlhttp.status);
		}													
	}														
	xmlhttp.open("GET", "scripts/php/getAvailableRooms.php?arrival=" + arrival + "&departure=" + departure, true);
	xmlhttp.send();											
}

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