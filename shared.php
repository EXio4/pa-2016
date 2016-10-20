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
	$database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	} catch (PDOException $e) {
		echo "ERROR connecting to database, maybe try running setup_miwi.php?</br>\n";
		die();
	}
	$umg = new \Lib\UserManagement($database);
	$feed = new \Lib\FeedManager($database);
	
	if(isset($_GET["logout"])) {
			$umg->logout();
	}
	
	$pages = null;
	{
		$normal_pages = array();
		$normal_pages[] = new \Template\PageInfo("home", "index.php", "Home");
	
		$self_page     = $_SERVER['PHP_SELF'];
		$self_page_enc = filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_ENCODED);
	
		$right_en = array();

		if ($umg->current_user() != null) {
			$normal_pages[] = new \Template\PageInfo("comment", "post.php" , "Post");
			$right_menu = new \Template\PageInfo("child", $self_page, $umg->current_user()->get_username());
			$right_en[] = new \Template\PageInfo("hashtag" , "profile.php" , "Profile");
			$right_en[] = new \Template\PageInfo("settings", "settings.php", "Settings");
			$right_en[] = new \Template\PageInfo("close", $self_page . "?logout=1", "Logout");
		} else {
			$right_menu = new \Template\PageInfo("child", $self_page, "User Info");
			$right_en[] = new \Template\PageInfo("user", "login.php?red=" . $self_page_enc, "Login");
			$right_en[] = new \Template\PageInfo("add user", "register.php?red=" . $self_page_enc, "Register");
		}
		
		$pages = new \Template\MenuBox($normal_pages, new \Template\NestedMenu($right_menu, $right_en));
	}

	function redirect($str) {
		header("Location: " . $str);
		die();
	}

?>
