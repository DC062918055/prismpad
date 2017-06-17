<?php
	session_start();
	$_SESSION["incorrect"] = "";
	$_SESSION["blank"] = "";
	$servername = "localhost";
	$username = "read";
	$password = "HF5YRx8B";
	$dbname = "sitedb";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error) {
		die();
	}
	$user = $_POST["username"];
	$pass = $_POST["password"];
	if($user == "" || $pass == "") {
		$_SESSION["blank"] = True;
		header("Location: /prismpad/?page=login");
		die();
	}
	$query = "SELECT * FROM members WHERE username = '" . $user . "'";
	$result = $conn->query($query);
	if($result) {
		while ($row = $result->fetch_assoc()) {
			if($row["password"] == $pass) {
				$_SESSION["userId"] = $row["id"];
				header("Location: /prismpad/?page=launch");
				die();
			}
			else {
				$_SESSION["incorrect"] = True;
				header("Location: /prismpad/?page=login");
				die();
			}
		}
	}
	else if(!$result) {
		$_SESSION["incorrect"] = True;
		header("Location: /prismpad/?page=login");
		die();
	}
?>
