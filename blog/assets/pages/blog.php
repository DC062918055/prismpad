<?php
	$servername = "localhost";
	$username = "write";
	$password = "QAQxy6vU";
	$dbname = "sitedb";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error ) {
		die();
	}
	$query = "SELECT * FROM blog WHERE id = " . $blog;
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	echo "<script type='text/javascript'>";
	echo "document.getElementById('blogTitle').innerHTML=\"" . $row["name"] . "\";";
	echo "document.title=\"" . $row["name"] . " | Blog by PrismPad\";";
	echo "document.body.style.backgroundImage=\"url('assets/backgrounds/" . $row["background"] . ".jpg')\";";
	echo "</script>";
	echo "<div class='blogDisplay'></div>";
	echo "<div class='blog'>";
	$query = "SELECT * FROM posts WHERE blogId = " . $blog . " ORDER BY postedAt DESC";
	$result = $conn->query($query);
	while($posts = $result->fetch_assoc()) {
		echo "<h2>";
		echo $posts["title"];
		echo "</h2>";
		echo "<p class='content'>";
		echo $posts["content"];
		echo "</p>";
		echo "<hr>";
		echo "<span class='postInfo'>Posted by ";
		echo $posts["author"];
		echo " on the ";
		$day = substr($posts["postedAt"], 8, 2);
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
		$month = substr($posts["postedAt"], 5, 2);
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
		$year = substr($posts["postedAt"], 0, 4);
		$date = $day . "<sup>" . $daySuffix . "</sup>" . " " . $monthWord . " " . $year;
		echo $date;
		echo " at ";
		echo substr($posts["postedAt"], 11, 5);
		echo ".</span>";
	}
	echo "</div>";
?>
