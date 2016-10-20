<?php

require_once "templates/page.php";
require_once "templates/register.php";

require_once "shared.php";


$return_site = "index.php";
if (isset($_GET["red"])) {
	$return_site = $_GET["red"];
}
$return_site_enc = filter_var($return_site, FILTER_SANITIZE_ENCODED);

$error = false;

if (isset($_POST["username"]) && isset($_POST["password"]) && isset($_POST["captcha"])) {
	$user = $_POST["username"];
	$pwd  = $_POST["password"];
	$cap  = $_POST["captcha"];
	
	if ($cap != $_SESSION['rand_code']) {
		$error = "Invalid captcha, try again.";
	} else {
		$error = $umg->add_user($user, $pwd) == null ? "Error creating user, maybe it already exists?" : false;
		if ($error === false) {
			redirect("index.php");
		}
	}	
}
if ($umg->current_user()) {
	redirect($return_site);
}


$page = new \Template\Page("Register", $pages, $umg->current_user(), new \Template\Register($return_site_enc, $error));
$page->render();




?>
