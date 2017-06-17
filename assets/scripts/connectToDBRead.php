<?php
	$servername = "%";
	$username = "read";
	$password = "HF5YRx8B";
	$dbname = "sitedb";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>
