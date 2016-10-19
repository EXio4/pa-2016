<?php

require_once "templates/page.php";
require_once "templates/index.php";

require_once "shared.php";


$own = $umg->current_user();

$page = new \Template\Page("Home", $pages, $umg->current_user(), new \Template\Index($own, $feed->get_feed()));
$page->render();




?>
