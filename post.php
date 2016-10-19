<?php

require_once "templates/page.php";
require_once "templates/feed_item.php";
require_once "templates/post.php";

require_once "shared.php";


$usr = $umg->current_user();

$parent = null;
if (isset($_GET["parent"])) {
	$parent = $feed->get_id($_GET["parent"]); // awful shit
}


if (isset($_POST["msg"])) {
	$msg = $_POST["msg"]; // awful shit
	$usr = $umg->current_user();
	if ($usr == null) die();
	$parent = $feed->get_feed($usr)->add_feed($msg,$parent);
}

if ($usr == null && $parent == null) {
	redirect("404.php");
}

$page = new \Template\Page("Post", $pages, $umg->current_user(),
              new \Template\Post($parent,$usr));
$page->render();

?>
