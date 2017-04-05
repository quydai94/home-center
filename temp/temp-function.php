<?php

function PrintTableData(){	
			// Database credentials.
			$servername = "localhost";
			$username = "root";
			$dbname = "home";
			$password = "root";
			// Number of entires to display.
			$display = 15;
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Get the most recent 10 entries.
			$result = mysqli_query($conn, "SELECT id, date, time, temp, humid FROM data ORDER BY id DESC LIMIT " . $display . "");
			echo '<table><tr><th>Date</th><th>Time</th><th>Temperature</th><th>Humidity</th><th>Status</th></tr>';
			while($row = mysqli_fetch_assoc($result)) {
			
				echo "<tr><td>";
				echo $row["date"];
				echo "</td><td>";
				echo $row["time"];
				echo "</td><td>";
				echo $row["temp"];
				echo "°C</td><td>";
				echo $row["humid"];
				echo "%</td><td>";
				if($row["temp"] < 15) echo "It's cold and ";
				if($row["temp"] >= 15 && $row["temp"] < 25) echo "It's normal and ";
				if($row["temp"] >= 25) echo "It's hot and ";
				if($row["humid"] < 60) echo "dry !";
				if($row["humid"] >= 60 && $row["humid"] < 90) echo "good !";
				if($row["humid"] >= 90) echo "wet !";
				echo "</td></tr>";
				$counter++;
			}
			
			echo '</table>';
			// Close connection.
			mysqli_close($conn);
}

function PrintChartData() {
			// Database credentials.
			$servername = "localhost";
			$username = "root";
			$dbname = "home";
			$password = "root";
			// Number of entires to display.
			$display = 10;
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Get the most recent 10 entries.
			$result = mysqli_query($conn, "SELECT id, date, time, temp, humid FROM data ORDER BY id DESC LIMIT " . $display . "");
			echo "<script> var data = [";
			while($row = mysqli_fetch_assoc($result)) {
				
				$z = date('Y-m-d H:i:s', strtotime("$row[date] $row[time]"));

				echo "{ y: '" . $row[time] . "', a: " . $row["humid"] . ", b: " .$row["temp"] . "},";

				
			}
			echo "];</script>";
			
					
			// Close connection.
			mysqli_close($conn);
}

?>
