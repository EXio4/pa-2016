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

$page = new \Template\Page("Profile", $pages, $umg->current_user(),
              new \Template\Profile($umg->current_user(), $feed->get_feed($usr)));
$page->render();

?>
