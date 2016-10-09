<?php

require_once "templates/page.php";
require_once "templates/feed_wrapper.php";

require_once "shared.php";



new \Template\Page("Main Feed", $pages, $umg->current_user(), new \Template\FeedWrapper($database)).render();




?>
