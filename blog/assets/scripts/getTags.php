<?php
	$tagB = strip_tags($_GET['b']);
	$tagS = strip_tags($_GET['s']);
	if($tagB != "") {
		$page = "blog";
		$blog = $tagB;
	}
	else if($tagS != "") {
		$page = "stats";
		$blog = $tagS;
	}
	else {
		$page = "home";
	}
?>
