<?php

	$year = ($_GET['year']);
	$month = ($_GET['month']);
	
	require("connect.php");
				
	$query = "SELECT Date, NumberOfDays, Room FROM reservation WHERE YEAR(Date) = $year AND MONTH(Date) = $month";
				
	$result = $mysqli->query($query);
		
	$table = "<table>
				<tr>
					<th>Res #</th>
					<th>Prefix</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Date of Res</th>
					<th>Days</th>
					<th>Guest</th>
					<th>Special Requests</th>
					<th>Room</th>
				</tr>";
				
	while($row = $result->fetch_array())
	{
		$id = $row["ReservationID"];
		$Prefix = $row["Prefix"];
		$FName = $row["FName"];
		$LName = $row["LName"];
		$Date = $row["Date"];
		$NumDays = $row["NumberOfDays"];
		$NumGuest = $row["NumberOfGuests"];
		$Requests = $row["SpecialRequest"];
		$Room = $row["Room"];
					
		$table .= "<tr>
					<td align='center'>$id</td>
					<td align='right'>$Prefix</td>
					<td>$FName</td>
					<td>$LName</td>
					<td>$Date</td>
					<td align='center'>$NumDays</td>
					<td align='center'>$NumGuest</td>
					<td>$Requests</td>
					<td align='center'>$Room</td>
				</tr>";
	}
				
	$table .= "</table>";
		
	echo $table;
	echo "something else";
?>