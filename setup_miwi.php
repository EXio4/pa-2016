<?php

	require_once "database_setup.php";

	require_once "lib/user_management.php";
	require_once "lib/feed.php";
	require_once "templates/page_info.php";
	
	session_start();
	try {
		$database = new PDO("mysql:host=$db_host", $db_user, $db_pwd, array(
										PDO::ATTR_PERSISTENT => true
									));
							
		$database->exec("CREATE DATABASE `$db_name`;");

		$database = null;

		$database = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pwd, array(
									PDO::ATTR_PERSISTENT => true
								));
								
	} catch (PDOException $e) {
		echo "Error connecting to database: $e\n</br>";
		die();
	}
	$umg = new \Lib\UserManagement($database);
	$feed = new \Lib\Feed($database);
	$umg->setup();echo "</br>\n";
	$feed->setup();echo "</br>\n";
	$umg->add_user("admin", "admin", 100);
	$umg->add_user("uader", "ProgramacionA2016", 0);
	$feed->add_feed("admin", "MiWi has been setup!");
	echo "Added admin and uader as users</br>\n";
	echo "You can delete setup_miwi.php now</br>\n";
	
?>
