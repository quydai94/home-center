<?php

	// Get values.
	$temp = $_GET['temp'];
	$humid = $_GET['humid'];
	$pass = $_GET['pass'];
	date_default_timezone_set('Asia/Ho_Chi_Minh');
	$date= date('Y-m-d');
	$time= date('H:i:s');
	
	// Set password. 
	$passcode = "123456";
	
	// Check if password is right.
	if(isset($pass) && ($pass == $passcode)){
		// If all values are present, insert it into the MySQL database.
		if(isset($temp)&&isset($humid)){
			// Database credentials
			$servername = "localhost";
			$username = "root";
			$dbname = "home";
			$password = "root";
			// Create connection.
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Insert values into table.
			$sql = "INSERT INTO data (date, time, temp, humid)
			VALUES ('$date', '$time', '$temp', '$humid')";
			if (mysqli_query($conn, $sql)) {
				echo "OK";
			} else {
				echo "Fail: " . $sql . "<br/>" . mysqli_error($conn);
			}
			
			// Close connection.
			mysqli_close($conn);
		}
	}
?>
