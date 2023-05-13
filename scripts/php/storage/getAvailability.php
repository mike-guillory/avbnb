<?php

	$year = ($_GET['year']);
	$month = ($_GET['month']);
	
	//$date = '01,' + $month + "," + $year;
	
	// get the number of days in the selected month and year
	$daysInTheMonth = cal_days_in_month(CAL_GREGORIAN,$month, $year);

	// get the day of the week (0 - 6) of the first day of the selected month and year
	$jd=gregoriantojd($month, 1, $year);
	$firstDayOfTheMonth = jddayofweek($jd,0);
	
	// require("connect.php");
				
	// $query = "SELECT Date, NumberOfDays, Room FROM reservation WHERE YEAR(Date) = $year AND MONTH(Date) = $month";
				
	// $result = $mysqli->query($query);
		
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
	while($i < $daysInTheMonth + $firstDayOfTheMonth)
	{
		$calendar .= "<tr>";
	
		while($dw <= 7 && $i < $daysInTheMonth + $firstDayOfTheMonth)
		{
			if($firstDayOfTheMonth == $i)
			{
				$calendar .= "<td>$date</td>";
				$date++;
			}
			elseif($firstDayOfTheMonth < $i)
			{
				$calendar .= "<td>$date</td>";
				$date++;
			}
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
		
	// $table = "<table>
				// <tr>
					// <th>Date of Res</th>
					// <th>Days</th>
					// <th>Room</th>
				// </tr>";
				
	// while($row = $result->fetch_array())
	// {
		// $Date = $row["Date"];
		// $NumDays = $row["NumberOfDays"];
		// $Room = $row["Room"];
					
		// $table .= "<tr>
					// <td>$Date</td>
					// <td align='center'>$NumDays</td>
					// <td align='center'>$Room</td>
				// </tr>";
	// }
				
	// $table .= "</table>";
		
	// echo $table;
	//echo "something else";
?>