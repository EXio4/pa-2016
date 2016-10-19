<?php

require_once "templates/page.php";
require_once "templates/settings.php";

require_once "shared.php";

if ($umg->current_user() == null) {
	redirect("404.php");
}
$page = new \Template\Page("Settings", $pages, $umg->current_user(), new \Template\Settings());
$page->render();




?>
