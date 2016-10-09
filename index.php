<?php

require_once "templates/page.php";
require_once "templates/feed_wrapper.php";

require_once "shared.php";



$page = new \Template\Page("Home", $pages, $umg->current_user(), new \Template\FeedWrapper(new \Lib\Feed($database)));
$page->render();




?>
