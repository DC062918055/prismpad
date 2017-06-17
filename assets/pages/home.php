<?php
	session_start();
	$servername = "localhost";
	$username = "read";
	$password = "HF5YRx8B";
	$dbname = "sitedb";
	$conn = new mysqli($servername, $username, $password, $dbname);
	if($conn->connect_error) {
		die();
	}
	echo "<div class='launch' id='displayBoxLaunch'></div>";
	echo "<div class='launch' id='contentBoxLaunch'>";
	echo "<table class='launchContainer'>";
		echo "<tr>";
			echo "<td class='logoContainer'><h1 class='launchTitle'>PrismPad</h1></td>";
			echo "<td class='logoContainer'>&nbsp;</td>";
			echo "<td class='logoContainer'>&nbsp;</td>";
			echo "<td class='logoContainer'>&nbsp;</td>";
			echo "<td class='logoContainer'>&nbsp;</td>";
			echo "<td class='logoContainer'>";
				if($_SESSION["userId"] !="") {
					$query = "SELECT username FROM members WHERE id = '" . $_SESSION["userId"] . "'";
					$result = $conn->query($query);
					$row = $result->fetch_assoc();
					echo "<span class='launchUsername'>" . $row["username"] . "</span>";
				}
				else {
					echo "<a href='/prismpad?page=login'><span class='launchUsername'> Login to PrismPad </span></a>";
				}
			echo "</td>";
		echo "</tr>";
	echo "</table>";
	echo"</div>";
?>
