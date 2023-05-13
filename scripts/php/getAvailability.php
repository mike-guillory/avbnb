<?php

	$year = ($_GET['year']);
	$month = ($_GET['month']) + 1;
	$days = ($_GET['days']);
			
	require("connect.php");
				
	$query = "SELECT Room FROM reservation WHERE YEAR(Date) = $year AND MONTH(Date) = $month AND DAY(Date) = $days[0]";	
		
 	$d = sizeof($days);
	for($i = 1; $i < $d; $i++)
	{
		$query .= " OR DAY(Date) = $days[$i]";
	} 
				
	$result = $mysqli->query($query);
		
	//$table = "<table>
				//<tr>";
		
	$availableRooms = array("JMR", "CMR", "SR");
		
	if($result != null)
	{		
		$row = $result->fetch_array();
		//while($row = $result->fetch_array())
		//{
			//$val = $row["Room"];
		
			if (in_array('1', $row)) 
			{
				unset($availableRooms[array_search('JMR',$availableRooms)]);
			}
			if (in_array('2', $row)) 
			{
				unset($availableRooms[array_search('CMR',$availableRooms)]);
			}
			if (in_array('3', $row)) 
			{
				unset($availableRooms[array_search('SR',$availableRooms)]);
			}

		//}
		
		//$table .= "</tr>
				//</table>";
				
		//echo $table;
		
		if(in_array("JMR", $availableRooms))
		{
			echo "JMR";
		}
		if(in_array("CMR", $availableRooms))
		{
			echo "CMR";
		}
		if(in_array("SR", $availableRooms))
		{
			echo "SR";
		}
	}
	
	// $table = "<table>
				// <tr>
					// <th>Date of Reservation</th>
					// <th>Days</th>
					// <th>Room</th>
				// </tr>";
	
	// if($result != null)
	// {
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
			
		//echo $table;
	//}
?>