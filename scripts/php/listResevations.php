<!DOCTYPE html>
<html lang="en">
<head>
	<title>Reservations List</title>
	<meta charset="utf-8">
</head>
<body>
	<div class="wrapper">
		<div class="reservation-list">
			<?php
			
				require("connect.php");
				
				$query = "SELECT * FROM Reservation";
				
				$result = $mysqli->query($query);
				
				$table = "<table>
							<tr>
								<th>Res #</th>
								<th>Prefix</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Date of Reservation</th>
								<th>Number of Nights</th>
								<th>Guest</th>
								<th>Special Requests</th>
								<th>Room</th>
							</tr>";
				
				while($row = $result->fetch_array())
				{
					$id = $row["ReservationID"];
					$Prefix = $row["Prefix"];
					$FName = $row["FirstName"];
					$LName = $row["LastName"];
					$Date = $row["FirstNight"];
					$NumDays = $row["NumberOfNights"];
					$NumGuest = $row["NumberOfGuests"];
					$Requests = $row["SpecialRequest"];
					$Room = $row["RoomID"];
					
					$table .= "<tr>
								<td align='center'>$id</td>
								<td align='right'>$Prefix</td>
								<td>$FName</td>
								<td>$LName</td>
								<td align='center'>$Date</td>
								<td align='center'>$NumDays</td>
								<td align='center'>$NumGuest</td>
								<td>$Requests</td>
								<td align='center'>$Room</td>
							</tr>";
				}
				
				$table .= "</table>";
				
				echo $table
				
			?>
		</div>
		<div class="calendar">
		
			<?php
				
				$thisYear = date("Y");
				
				$year = "<select id='year'>
							<option value=$thisYear>$thisYear</option>";
				
				$i = 1;
				while($i <= 2)
				{
					$thisYear = $thisYear + 1;
					
					$year .= "<option value=$thisYear>$thisYear</option>";

					$i++;
				};
				
				$year .= "</select>";
											
				echo $year;
			?>
		

		</div>
	</div>
</body>
</html>