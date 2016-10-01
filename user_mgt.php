<?php

namespace UserManagement;

if (isset($loaded)) { return; }
$loaded = true;



$all_users = array();


class User {
	const TYPE_ADMIN  = 0;
	const TYPE_NORMAL = 1;
	var $type;
	var $username;
	var $password; /* should be hashed */
	
	function __construct($u, $p, $t = TYPE_NORMAL) {
		global $all_users;
		$this->username = $u;
		$this->password = $p;
		$this->type = $t;
		$all_users[] = $this;
	}
	
	function valid_login_data($u, $p) {
		return ($u == $this->username && $p == $this->password);
	}
}


{ 
	new User("uader", "ProgramacionA2016", User::TYPE_NORMAL);
	new User("admin", "admin", User::TYPE_ADMIN);
}

function init() {
	if (!isset($_SESSION["login"])) {
		$_SESSION["login"] = null;
	}
}

function login($username, $password) {
	global $all_users;
	$x = null;
	foreach ($all_users as $user) {
		if ($user->valid_login_data($username, $password)) {
			$x = $user;
			break;
		}
	}
	$_SESSION["login"] = $x;
	return is_logged();
}

function logout() {
	$_SESSION["login"] = null;
}

function user() {
	return $_SESSION["login"];
}

function is_logged() {
	return ($_SESSION["login"] != null);
}

function delete() {
}

?>
