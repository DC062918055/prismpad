<?php
	session_start();
	$_SESSION["userTaken"] = "";
	$_SESSION["registerDisplay"] = "";
	$servername = "localhost";
	$username = "write";
	$password = "QAQxy6vU";
	$dbname = "sitedb";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error) {
		die();
	}
	$fName = $_POST["fName"];
	$sName = $_POST["sName"];
	$eAddr = strtolower($_POST["eAddr"]);
	$uName = $_POST["uName"];
	$pWord = $_POST["pWord"];
	$query = "SELECT * FROM members WHERE username = '" . $uName . "'";
	$result = $conn->query($query);
	if($result->num_rows == 0) {
		$query = "INSERT INTO members (username, password, firstname, surname, email) VALUES ('" . $uName . "', '" . $pWord . "', '" . $fName . "', '" . $sName . "', '" . $eAddr . "')";
		$result = $conn->query($query);
		$query = "SELECT * FROM members WHERE username = '" . $uName . "'";
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		$_SESSION["userId"] = $row["id"];
		header("Location: /prismpad?page=launch");
		die();
	}
	else {
		$_SESSION["userTaken"] = True;
		$_SESSION["registerDisplay"] = True;
		header("Location: /prismpad?page=login");
		die();
	}
?>
