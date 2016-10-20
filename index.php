<?php

require_once "templates/page.php";
require_once "templates/index.php";

require_once "shared.php";


$own = $umg->current_user();


$num_page = 1;
if (isset($_GET["page"])) {
	$num_page = $_GET["page"];
}

$page = new \Template\Page("Home", $pages, $umg->current_user(), new \Template\Index($own, $feed->get_feed(), $num_page));
$page->render();




?>
