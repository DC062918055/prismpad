<?php
	$tagQ = strip_tags($_GET['q']);
	$tagS = strip_tags($_GET['s']);
	if($tagQ != "") {
		$page = "quiz";
		$quiz = $tagQ;
	}
	else if($tagS != "") {
		$page = "stats";
		$quiz = $tagS;
	}
	else {
		$page = "home";
	}
?>
