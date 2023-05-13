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
	
	// get the number of days in the selected month and year
	$daysInTheMonth = cal_days_in_month(CAL_GREGORIAN,$month, $year);

	// get the day of the week (0 - 6) of the first day of the selected month and year
	$jd = gregoriantojd($month, 1, $year);
	$firstDayOfTheMonth = jddayofweek($jd,0);
	
	if($firstDayOfTheMonth == 0)
	{
		$firstDayOfTheMonth = 7;
	}
		
	$calendar = "<table id='calendar' class='calendar'>
					<tr>
						<th>Monday</th>
						<th>Tuesday</th>
						<th>Wednesday</th>
						<th>Thursday</th>
						<th>Friday</th>
						<th>Saturday</th>
						<th>Sunday</th>
					</tr>";
	$i = 1;
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
				$calendar .= "<td></td>";
			}
			
			$i++;
			$dw++;
		}
		
		$calendar .= "</tr>";
		
		$dw = 1;
	}
	
	echo $calendar;
?>