<?php


	require_once "database_setup.php";

	require_once "lib/user_management.php";
	require_once "lib/feed.php";
	require_once "templates/page_info.php";
	
	session_start();

	try {
	$database = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pwd, array(
									PDO::ATTR_PERSISTENT => true
								));
	} catch (PDOException $e) {
		echo "ERROR connecting to database, maybe try running setup_miwi.php?</br>\n";
		die();
	}
	$umg = new \Lib\UserManagement($database);
	
	if(isset($_GET["logout"])) {
			$umg->logout();
	}
	
	$pages = array();
	array_push($pages, new \Template\PageInfo("home", "index.php", "Main feed"));

?>
