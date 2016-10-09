<?php
namespace Lib;

require_once "feed.php";

class User {
	private $db;
	private $user; /* invariant: $user always exists on $db */
	/* should not be called outside of UserManagement
	 * I am not using a design pattern to hide this detail
	 * broken languages shall stay broken
	 * */
	public function __construct($db, $user) {
		$this->db = $db;
		$this->user = $user;
	}
	public function get_username() {
		return $this->user;
	}
    public function get_feed() {
        return new Feed($this->db, $this->user);
    }
    
	public function set_password($new_password) {
		try {
			$stm = $this->db->prepare("UPDATE users SET password_hash = ? WHERE username = ?");
			$password_hash = hash("sha512", $new_password);
			$stm->execute(array($password_hash, $this->user));
			return true;
		} catch (PDOException $e) {
			return false;
		}
	}
	private function get_pwd_hash() {
		try {
			$stm = $this->db->prepare("SELECT password_hash FROM users where username = ?");
			if ($stm->execute($this->user)) {
			  while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				  return $row->password_hash;
			  }
			}
		} catch (PDOException $e) {
		}
		return null;
	}
	public function check_password($password) {
		return hash("sha512", $password) == $this->get_pwd_hash();
	}
}

class UserManagement {
	private $db;
	public function __construct($db) {
		$this->db = $db;
        if (!isset($_SESSION["login"])) {
            $_SESSION["login"] = null;
        }
	}
	public function setup() {
        try {
            $this->db->exec("CREATE TABLE users(
                                username      VARCHAR(32)  NOT NULL PRIMARY KEY,
                                password_hash VARCHAR(128) NOT NULL,
                                rank          INT(8)       NOT NULL);");
			echo "Created user table\n";
		} catch (PDOException $e) {
			echo "Error setting up user table ($e)";
		}
	}
	public function get_user($user) {
		try {
			$stm = $this->db->prepare("SELECT username FROM users where username = ?");
			if ($stm->execute($user)) {
                if ($stm->fetch(PDO::FETCH_OBJ)) {
                    return new User($this->db, $user);
                }
			}
		} catch (PDOException $e) {
		}
		return null;
	}
	public function check_login_data($user, $password) {
		$usr = $this->get_user($user);
		if ($usr) {
			return $usr->check_password($password);
		} else {
			return false;
		}
	}
	public function add_user($user, $password, $rank = 0) {
		try {
			$stm = $this->db->prepare("INSERT INTO users (username, password_hash, rank) VALUES (?, ?, ?)");
			$password_hash = hash("sha512", $password);
			$stm->execute(array($user, $password_hash, $rank));
			return new User($this->db, $user);
		} catch (PDOException $e) {
		}
        return null;
	}
	public function list_users() {
		try {
			$stm = $this->db->prepare("SELECT username FROM users where username = ?");
			$arr = array();
			if ($stmt->execute(array($user))) {
			  while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($arr, new User($this->db, $row->username));
			  }
			}
			return $arr;
		} catch (PDOException $e) {
			return array();
		}
	}
    public function current_user() {
        if ($_SESSION["login"]) {
            return new User($this->db, $_SESSION["login"]);
         }
         return null;
    }
    public function login($username, $password) {
        if (check_login_data($username, $password)) {
            $_SESSION["login"] = $username;
        }
    }
    public function logout() {
        $_SESSION["login"] = null;
    }
}


?>
