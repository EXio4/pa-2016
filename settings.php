<?php

require_once "templates/page.php";
require_once "templates/settings.php";

require_once "shared.php";

$usr = $umg->current_user();
if ($usr == null) {
	redirect("404.php");
}

$message = "";

if (isset($_POST["pwd_old"]) && isset($_POST["pwd_curr"]) && isset($_POST["pwd_curr_2"])) {
	
	if ($usr->check_password($_POST["pwd_old"])) {
		if ($_POST["pwd_curr"] === $_POST["pwd_curr_2"]) {
			if ($_POST["pwd_curr"] != "") {
				$usr->set_password($_POST["pwd_curr"]);
				$message = "Changed password correctly";
			} else {
				$message = "New password can't be empty";
			}
		} else {
			$message = "Passwords don't match";
		}
	} else {
		$message = "Invalid password";
	}
	
}

$page = new \Template\Page("Settings", $pages, $umg->current_user(), new \Template\Settings($message));
$page->render();




?>
