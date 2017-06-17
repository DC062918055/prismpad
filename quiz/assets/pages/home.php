<?php
	session_start();
	if($_SESSION["userId"] == "") {
		header("Location: /prismpad?page=login");
		die();
	}
	else {
		echo "<div class='quizzesDisplay'></div>";
		echo "<div class='quizzes'>";
		echo "<h1>myQuiz</h1>";
		echo "<div id='list'>";
		$servername = "localhost";
		$username = "read";
		$password = "HF5YRx8B";
		$dbname = "sitedb";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if($conn->connect_error) {
			die();
		}
		$query = "SELECT * FROM members WHERE id = " . $_SESSION["userId"];
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		$author = $row["username"];
		$query = "SELECT * FROM quiz WHERE author = '" . $author . "' ORDER BY id DESC";
		$result = $conn->query($query);
		echo "<table>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td class='name'>";
			echo "<span>";
			echo $row["name"];
			echo "</span>";
			echo "</td>";
			echo "<td class='rightWide'>";
			echo "<span><a href='/prismpad/quiz?s=" . $row["id"] . "'>";
			echo "stats";
			echo "</a></span>";
			echo "</td>";
			echo "<td class='rightWide'>";
			echo "<span><a href='/prismpad/quiz?q=" . $row["id"] . "'>";
			echo "view";
			echo "</a></span>";
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "</div>";
		echo "</div>";
	}
?>
