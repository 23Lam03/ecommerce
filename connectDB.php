

<!-- Connect Database -->

	<?php
	$servername = "localhost";
	$database = "shoppingonline";
	$username = "root";
	$password = "";

	// Create connection
	$conn = mysqli_connect($servername, $username, $password, $database);

	// Check connection

	if ($conn->connect_error) {
	die($conn->connect_error);
	}
	
?>