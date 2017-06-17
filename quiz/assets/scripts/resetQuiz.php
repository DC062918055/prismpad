<?php
	session_start();
	$quiz = $_POST["quiz"];
	$_SESSION["questionsAsked$quiz"] = "";
	$_SESSION["completed$quiz"] = "";
	header("Location: /prismpad/quiz?q=" . $quiz);
	die();
?>
