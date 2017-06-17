<?php
	session_start();
	if($_SESSION["userId"] == "") {
		header("Location: /prismpad?page=login");
		die();
	}
	else {
		$servername = "localhost";
		$username = "read";
		$password = "HF5YRx8B";
		$dbname = "sitedb";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if($conn->connect_error) {
			die();
		}
		$query = "SELECT username FROM members WHERE id = " . $_SESSION["userId"];
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		$accessingUsername = $row["username"];
		$query = "SELECT * FROM quiz WHERE id = " . $quiz;
		$result = $conn->query($query);
		$row = $result->fetch_assoc();
		if($accessingUsername == $row["author"] || $accessingUsername == "admin") {
			echo "<div class='statsDisplay'></div>";
			echo "<div class='stats'>";
			echo "<a href='/prismpad/quiz'><img class='right' src='assets/close.png'></a>";
			echo "<h1>" . $row["name"] . "</h1>";
			echo "<div class='views'>";
			echo "<p>viewed<span class='score'></br>";
			echo $row["views"];
			echo "<br></span>times";
			echo "</div>";
			echo "<div class='completed'>";
			echo "<p>completed<span class='score'><br>";
			echo $row["completed"];
			echo "<br></span>times</p>";
			echo "</div>";
			echo "<div class='lastViewed'>";
			echo "<p>last viewed by<span class='score'><br>";
			echo $row["lastViewedBy"];
			echo "<br></span>on<span class='score'><br>";
			$day = substr($row["lastViewedAt"], 8, 2);
			if(substr($day, 0, 1) == "0") {
				$day = substr($day, 1, 1);
			}
			if(substr($day, 1, 1) == "1" && substr($day, 0, 1) != 1) {
				$daySuffix = "st";
			}
			if(substr($day, 1, 1) == "2" && substr($day, 0, 1) != 1) {
				$daySuffix = "nd";
			}
			if(substr($day, 1, 1) == "3" && substr($day, 0, 1) != 1) {
				$daySuffix = "rd";
			}
			else {
				$daySuffix = "th";
			}
			$month = substr($row["lastViewedAt"], 5, 2);
			if($month == "01") { $monthWord = "January"; }
			if($month == "02") { $monthWord = "Feburary"; }
			if($month == "03") { $monthWord = "March"; }
			if($month == "04") { $monthWord = "April"; }
			if($month == "05") { $monthWord = "May"; }
			if($month == "06") { $monthWord = "June"; }
			if($month == "07") { $monthWord = "July"; }
			if($month == "08") { $monthWord = "August"; }
			if($month == "09") { $monthWord = "September"; }
			if($month == "10") { $monthWord = "October"; }
			if($month == "11") { $monthWord = "November"; }
			if($month == "12") { $monthWord = "December"; }
			$year = substr($row["lastViewedAt"], 0, 4);
			$date = $day . "<sup>" . $daySuffix . "</sup>" . " " . $monthWord . " " . $year;
			echo $date;
			echo "<br></span>at<span class='score'><br>";
			echo substr($row["lastViewedAt"], 11, 5);
			echo "</span></p>";
			echo "</div>";
			echo "<div class='averageScore'>";
			echo "<p>average score<span class='score'><br>";
			echo $row["avgScore"];
			echo "%</span></p>";
			echo "</div>";
			echo "<div class='averageCompletion'>";
			echo "<p>completion rate<span class='score'><br>";
			echo round((($row["completed"] / $row["views"])*100),2,PHP_ROUND_HALF_UP);
			echo "%</span></p>";
			echo "</div>";
			echo "</div>";
		}
		else {
			header("Location: /prismpad/quiz");
			die();
		}
	}
?>
