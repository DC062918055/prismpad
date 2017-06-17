<?php
	session_start();
	if($_SESSION["userId"] == "") {
		header("Location: /prismpad?page=login");
		die();
	}
	else {
		$servername = "localhost";
		$username = "write";
		$password = "QAQxy6vU";
		$dbname = "sitedb";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if($conn->connect_error) {
			die();
		}
		$query = "SELECT * FROM members WHERE id = " . $_SESSION["userId"];
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		$username = $row["username"];
		$now = getdate();
		$datetime = $now["year"] . "-" . $now["mon"] . "-" . $now["mday"] . " " . $now["hours"] . ":" . $now["minutes"] . ":" . $now["seconds"];
		$query = "SELECT * FROM quiz WHERE id = " . $quiz;
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		$name = $row["name"];
		$author = $row["author"];
		$views = $row["views"];
		$query = "SELECT COUNT(*) AS questionNumber FROM questions WHERE quizId = " . $quiz;
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		$num = $row["questionNumber"];
		$query = "SELECT * FROM questions WHERE quizId = " . $quiz;
		$result = $conn->query($query);
		$pass = 1;
		if($_SESSION["questionsAsked$quiz"] == "") {
			$query = "UPDATE quiz SET views = " . ($views+1) . " WHERE id = " . $quiz;
			$conn->query($query);
			$query = "UPDATE quiz SET lastViewedBy = '" . $username . "' WHERE id = " . $quiz;
			$conn->query($query);
			$query = "UPDATE quiz SET lastViewedAt = '" . $datetime . "' WHERE id = " . $quiz;
			$conn->query($query);
			$questions = rand(1, $num);
			$_SESSION["first$quiz"] = true;
			$_SESSION["totalQ$quiz"] = 0;
			$_SESSION["correctQ$quiz"] = 0;
		}
		else if($_SESSION["totalQ$quiz"] == $num) {
			$done == True;
		}
		else {
			$questions = rand(1, $num);
			if(in_array($questions, $_SESSION["questionsAsked$quiz"]) == true) {
				$findQuestion = 0;
				while($findQuestion == 0) {
					$questions = rand(1, $num);
					if(in_array($questions, $_SESSION["questionsAsked$quiz"]) == false) {
						$findQuestion = 1;
					}
				}
			}
			array_push($_SESSION["questionsAsked$quiz"], $questions);
		}
		while($row = $result->fetch_assoc()) {
			if($pass == $questions) {
				$quote = $row["quote"];
				$question = $row["question"];
				$questionId = $row["questionId"];
				$pass = $pass + 1;
			}
			else {
				$pass = $pass + 1;
			}
		}
		echo "<div class='questionsDisplay'></div>";
		echo "<div class='questions'>";
		echo "<h1>" . $name . "<br><span class='author'>Created by " . $author . "</span></h1>";
		echo "<p>";
		if($_SESSION["prevAnswer"] == "correct") {
			echo "<span class='correct'>Your last answer was correct. Congratulations!</span>";
		}
		else if($_SESSION["prevAnswer"] == "incorrect") {
			echo "<span class='incorrect'>Your last answer was incorrect.</span>";
		}
		echo "</p>";
		$_SESSION["prevAnswer"] = "";
		echo "<p id='quote'>" . $quote . "</p>";
		echo "<p id='question'>" . $question . "</p>";
		echo "<center><form method='post' action='assets/scripts/checkQuestion.php' enctype='multipart/form-data' autocomplete='off'>";
		echo "<input name='answer' class='answer' type='text' placeholder='answer' autofocus><br>";
		echo "<div class='space'></div>";
		echo "<input name='quiz' type='text' value='" . $quiz . "' hidden>";
		echo "<input name='question' type='text' value='" . $questions . "' hidden>";
		echo "<input name='questionId' type='text' value='" . $questionId . "' hidden>";
		echo "<input class='submit' type='submit' value='Check'>";
		echo "</form></center>";
		echo "<p id='score'>" . $_SESSION["correctQ$quiz"] . "/" . $_SESSION["totalQ$quiz"] . "</p>";
		echo "</div>";
		echo "<div class='questions' id='finished' style='display: none;'>";
		echo "<h1>" . $name . "<br><span class='author'>Created by " . $author . "</span></h1>";
		echo "<p><span class='score'>Congratulations!</span><br>You completed the quiz with a score of:</p>";
		echo "<p class='score'>" . ($_SESSION["correctQ$quiz"] / $_SESSION["totalQ$quiz"]) * 100 . "%</p>";
		echo "<center><form method='post' action='assets/scripts/resetQuiz.php' autocomplete='off'>";
		echo "<input type='text' name='quiz' value='" . $quiz . "' hidden>";
		echo "<input class='submit' type='submit' value='Reset Quiz'>";
		echo "</form></center>";
		echo "</div>";
		if($_SESSION["totalQ$quiz"] == $num) {
			echo "<script type='text/javascript'>";
			echo "document.getElementById('finished').style.display='block';";
			echo "</script>";
			if($_SESSION["completed$quiz"] == "") {
				$query = "SELECT completed, avgScore FROM quiz WHERE id = " . $quiz;
				$result = $conn->query($query);
				$row = $result->fetch_assoc();
				$completed = $row["completed"];
				$average = $row["avgScore"];
				$unAverage = $average*$completed;
				$nowCompleted = $completed+1;
				$query = "UPDATE quiz SET completed = " . $nowCompleted . " WHERE id = " . $quiz;
				$conn->query($query);
				$nowAverage = ($unAverage + (($_SESSION["correctQ$quiz"] / $_SESSION["totalQ$quiz"])*100)) / $nowCompleted;
				$query = "UPDATE quiz SET avgScore = " . $nowAverage . " WHERE id = " . $quiz;
				$conn->query($query);
				$_SESSION["completed$quiz"] = true;
			}
		}
	}
?>
