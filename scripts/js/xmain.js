// $.ajaxSetup ({
//     cache: false
// });

$(function() {

	$('span.nav-btn').click(function(){
		$('ul.main-nav').slideToggle().css('font-size', '30px');				
	});
			
	$(window).resize(function(){
		if($(window).width() > 560){
			$('ul.main-nav').removeAttr('style');
		}
	});

	var today = new Date();
	var month = today.getMonth();
	var year = today.getFullYear();
	var currentPage = location.pathname.split('/').slice(-1)[0];
		$("a[href$='"+currentPage+"']").addClass("current").attr("id", "current");


	$(document).ready(function(){

		$('li > a').hover(function(){
			if($(this).not('btn-reservations'))
			{
				$('#current').toggleClass('current');
			}	
		});

		populateYearSelectList();
		
		populateMonthSelectList();
	});

	$(window).load(function(){

		if((currentPage == "testimonials" || currentPage == "gallery") && $(window).width() > 767){

			setTimeout(function(){equalHeight($(".column"));}, 1000);

			//equalHeight($(".column"));

		}

	});

	// This makes checkboxes that are grouped by a common name
	// behave like radio button (you can only select one).
	// The checkboxes also have the class "radio" to distinquish
	// them from any other checkboxs on the page.
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

	function equalHeight(group) { // Modified from cssnewbie.com

		var tallest = $(window).height() - 210;

		group.each(function() {

		   thisHeight = $(this).height();

	       if(thisHeight > tallest) {
	          tallest = thisHeight;

	    	}
	    });	
	    group.height(tallest);	

	}
});