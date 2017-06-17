<?php
	session_start();
	$quiz = $_POST["quiz"];
	$question = $_POST["question"];
	$questionId = $_POST["questionId"];
	$answer = strtolower($_POST["answer"]);
	$servername = "localhost";
	$username = "read";
	$password = "HF5YRx8B";
	$dbname = "sitedb";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error) {
		die();
	}
	$query = "SELECT * FROM questions WHERE questionId = " . $questionId;
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	$_SESSION["totalQ$quiz"] = $_SESSION["totalQ$quiz"] + 1;
	if($answer == $row["answer"]) {
		$_SESSION["prevAnswer"] = "correct";
		$_SESSION["correctQ$quiz"] = $_SESSION["correctQ$quiz"] + 1;
	}
	else {
		$_SESSION["prevAnswer"] = "incorrect";
	}
	if($_SESSION["first$quiz"] == true) {
		$_SESSION["questionsAsked$quiz"] = array($question);
		$_SESSION["first$quiz"] = false;
	}
	else {
		array_push($_SESSION["questionsAsked$quiz"], $question);
	}
	header("Location: /prismpad/quiz?q=" . $quiz);
	die();
?>