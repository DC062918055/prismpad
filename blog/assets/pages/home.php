<?php
	session_start();
	if($_SESSION["userId"] == "") {
		header("Location: /prismpad?page=login");
		die();
	}
	else {
		echo "<div class='blogsDisplay'></div>";
		echo "<div class='blogs'>";
		echo "<h1>myBlog</h1>";
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
		$query = "SELECT * FROM blog WHERE author = '" . $author . "' ORDER BY id DESC";
		$result = $conn->query($query);
		echo "<table>";
		while($row = $result->fetch_assoc()) {
			echo "<tr>";
			echo "<td class='name'>";
			echo "<span class='label'>";
			echo $row["name"];
			echo "</span>";
			echo "</td>";
			echo "<td class='rightWide'>";
			echo "<span><a href='/prismpad/blog?s=" . $row["id"] . "'>";
			echo "stats";
			echo "</a></span>";
			echo "</td>";
			echo "<td class='rightWide'>";
			echo "<span><a href='/prismpad/blog?b=" . $row["id"] . "'>";
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
