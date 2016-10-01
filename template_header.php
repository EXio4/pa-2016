<?php


include "shared.php";
include "feed_lib.php";
include "user_mgt.php";

session_start(); 
ob_start();
/* if template_header has been loaded previous, we simply ignore this extra include */
if (isset($template_header_loaded)) { return; };
$template_header_loaded = true;


if (!\UserManagement\init()) {
	// handle error case later on
}
\Feed\init();

if(isset($_GET["logout"])) {
	\UserManagement\logout();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php $title ?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="s-ui/semantic.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="s-ui/semantic.min.js"></script>
</head>

<body>
<div class="ui attached stackable menu">
  <div class="ui container">
    <a class="header item" href="index.php">
      <i class="home icon"></i>Home
    </a>
	<div class="right menu">
		<?php
			if (\UserManagement\is_logged()) {
				echo "<a class=\"item\" href=\"index.php?logout=1\">Logout</a>";
			} else {
				echo "<a class=\"item\" href=\"login.php?red=";
				echo filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_ENCODED);
				echo "\">Login</a>";
			}
		?>
	</div>
  </div>
</div>

<div class="ui container">
<div class="ui raised container segment">
	<h3 class="ui header">Programacion Avanzada TP2</h3>
</div>
