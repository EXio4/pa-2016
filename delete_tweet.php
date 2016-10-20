<?php

require_once "templates/page.php";
require_once "templates/delete_tweet.php";

require_once "shared.php";


$own = $umg->current_user();

if ($own == null) {
	redirect("404.php");
}

if (!isset($_GET["id"])) {	
	redirect("404.php");
}

$fd = $feed->get_id($_GET["id"]);

if ($fd->get_username() != $own->get_username()) {
	redirect("404.php");
}

$error = false;
if (!isset($_POST["captcha"])) {
	// ignore, we don't really wanna delete the message this time
} else if($_POST["captcha"] == $_SESSION["rand_code"]) {
	$fd->kill($own);
	redirect("index.php");
} else {
	// failed
	$error = "Failed captcha";
}


$page = new \Template\Page("Delete Tweet", $pages, $umg->current_user(), new \Template\DeleteTweet($own, $fd, $error));
$page->render();




?>

?>
