<?php

require_once "templates/page.php";
require_once "templates/profile.php";

require_once "shared.php";


if (isset($_GET["user"])) {
	$usr = $umg->get_user($_GET["user"]);
	$own = false;
} else {
	$usr = $umg->current_user();
	$own = true;
}

if ($usr == null) {
	redirect("404.php");
}

if (isset($_POST["msg"])) {
	$msg = $_POST["msg"];
	$usr = $umg->current_user();
	if ($usr == null) die();
	$feed->get_feed($usr)->add_feed($msg);
}


$page = new \Template\Page("Profile", $pages, $umg->current_user(),
              new \Template\Profile($usr, $own, $feed->get_feed($usr)));
$page->render();

?>
