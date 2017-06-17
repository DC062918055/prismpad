<?php
	include "assets/templates/head.php";
	include "assets/scripts/getTags.php";
	echo "<body>";
	session_start();
	if($_SESSION["userId"] != "") {
		include "assets/templates/header.php";
	}
	else {
		include "assets/templates/title.php";
	}
	include "assets/pages/" . $page . ".php";
	echo "</body>";
	echo "</html>";
?>
