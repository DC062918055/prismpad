<?php
	include "assets/templates/head.php";
	include "assets/scripts/getTags.php";
	echo "<body>";
	include "assets/pages/" . $page . ".php";
	echo "</body>";
?>
