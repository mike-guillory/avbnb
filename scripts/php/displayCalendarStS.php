<?php

	/////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////
	// CONVERT THIS TO javascript ///////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////

	$year = ($_GET['year']);
	$month = ($_GET['month']) + 1;
	$lastMonth = ($month - 1);
	$lastYear = $year;
	if($lastMonth == 11)
	{
		$lastYear = ($year - 1);
	}
	
	// get the number of days in the selected month and year
	$daysInTheMonth = cal_days_in_month(CAL_GREGORIAN,$month, $year);
	$daysInTheLastMonth = cal_days_in_month(CAL_GREGORIAN,$lastMonth, $lastYear);

	// get the day of the week (0 - 6) of the first day of the selected month and year
	$jd = gregoriantojd($month, 1, $year);
	$firstDayOfTheMonth = jddayofweek($jd,0);
		
	$calendar = "<table id='calendar' class='calendar'>
					<tr>
						<th>Sunday</th>
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
						
					</tr>";
	$i = 0;
	$dw = 1;
	$date = 1;
	$go = false;
	while($i < $daysInTheMonth + $firstDayOfTheMonth)
	{
		$calendar .= "<tr>";
	
		while($dw <= 7 && $i < $daysInTheMonth + $firstDayOfTheMonth)
		{
			if($firstDayOfTheMonth == $i || $go)
			{
				$calendar .= "<td onclick='highlight(this)'>$date</td>";//<a href='../index.html' class='calendarLink'>$date</a></td>";
				$date++;
				$go = true;
			}
			// elseif($firstDayOfTheMonth < $i)
			// {
				// $calendar .= "<td onclick='highlight(this)'>$date</td>";//<a href='../index.html' class='calendarLink'>$date</a></td>";
				// $date++;
			// }
			else
			{
				// $lastMonthsDate = $daysInTheLastMonth;
				// $calendar .= "<td onclick='highlight(this)'>$lastMonthsDate</td>";
				// $lastMonthsDate
			}
			
			$i++;
			$dw++;
		}
		
		$calendar .= "</tr>";
		
		$dw = 1;
	}
	
	echo $calendar;
?>