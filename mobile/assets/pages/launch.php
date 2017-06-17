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
	$query = "SELECT username FROM members WHERE id = '" . $_SESSION["userId"] . "'";
	$result = $conn->query($query);
	$row = $result->fetch_assoc();
	if($_SESSION["userId"] != "") {
		echo "<div class='launch' id='displayBoxLaunch'></div>";
		echo "<div class='launch' id='contentBoxLaunch'>";
		echo "<table class='launchContainer'>";
			echo "<tr>";
				echo "<td class='logoContainer'><h1 class='launchTitle'>PrismPad</h1></td>";
				echo "<td class='logoContainer'></td>";
				echo "<td class='logoContainer'></td>";
				echo "<td class='logoContainer'></td>";
				echo "<td class='logoContainer'></td>";
				echo "<td class='logoContainer'><span class='launchUsername'>" . $row["username"] . "</span></td>";
			echo "</tr>";
			echo "<tr>";
					echo "<td class='logoContainer'><img class='launchIcon' id='textLogo' src='assets/textLogo.png'></td>";
					echo "<td class='logoContainer'><a href='quiz' target='_blank'><img class='launchIcon' id='quizLogo' src='assets/quizLogo.png'></a></td>";
					echo "<td class='logoContainer'><a href='blog' target='_blank'><img class='launchIcon' id='blogLogo' src='assets/blogLogo.png'></a></td>";
					echo "<td class='logoContainer'><img class='launchIcon' id='textLogo' src='assets/textLogo.png'></td>";
					echo "<td class='logoContainer'><img class='launchIcon' id='textLogo' src='assets/textLogo.png'></td>";
					echo "<td class='logoContainer'><img class='launchIcon' id='textLogo' src='assets/textLogo.png'></td>";
			echo"</tr>";
			echo "<tr>";
					echo "<td class='logoContainer'><img class='launchIcon' id='textLogo' src='assets/textLogo.png'></td>";
					echo "<td class='logoContainer'><img class='launchIcon' id='textLogo' src='assets/textLogo.png'></td>";
					echo "<td class='logoContainer'><img class='launchIcon' id='textLogo' src='assets/textLogo.png'></td>";
					echo "<td class='logoContainer'><a href='assets/scripts/logout.php'><img class='launchIcon' id='logoutLogo' src='assets/logout.png'></a></td>";
					echo "<td class='logoContainer'></td>";
					echo "<td class='logoContainer'><a href='/prism' target='blank'><img class='launchIcon' id='prismLogo' src='assets/logoPrism.png'></a></td>";
			echo"</tr>";
		echo"</div>";
	}
	else {
		header("Location: /prismpad?page=login");
		die(); 
	}
?>
