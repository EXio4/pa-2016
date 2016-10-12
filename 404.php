<?php

require_once "templates/page.php";
require_once "templates/404.php";

require_once "shared.php";



$page = new \Template\Page("404", $pages, $umg->current_user(), new \Template\PageNotFound());
$page->render();




?>
