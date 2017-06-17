<?php
	$tag = strip_tags($_GET['page']);
	if($tag == "") {
		$page = "home";
	}
	else {
		$page = $tag;
	}
?>
