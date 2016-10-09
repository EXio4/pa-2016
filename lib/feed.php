<?php
namespace Lib;

class FeedItem {
    private $db;
    private $item_id;
    private $username;
    private $text;
    private $parnt;
    public function __construct($db, $item_id, $username, $text, $parent = null) {
        $this->db       = $db;
        $this->item_id  = $item_id;
        $this->username = $username;
        $this->text     = $text;
        $this->parnt    = $parent;
    }
    public function get_id() {
        return $this->item_id;
    }
    public function get_username() {
        return $this->username;
    }
    public function get_text() {
        return $this->text;
    }
    public function get_parent() {
        return null;
    }
    
}

class Feed {
	private $db;
	private $user; /* null represents global feed */
	
	public function __construct($db, $user = null) {
		$this->db = $db;
		$this->user = $user;
	}

	public function setup() {
		try {
			$this->db->exec("CREATE TABLE feed(
                                feed_item_id  INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
                                username      VARCHAR(32)  NOT NULL,
                                text          VARCHAR(256) NOT NULL,
                                parnt         INT(64)      );");
			echo "Created feed table\n";
		} catch (PDOException $e) {
			echo "Error setting up feed table ($e)";
		}
	}
	
	public function get_items() {
		try {
            if ($this->user) {
                $stm = $this->db->prepare("SELECT feed_item_id,username,text,parnt FROM feeds where username = ?");
            } else {
                $stm = $this->db->prepare("SELECT feed_item_id,username,text,parnt FROM feeds");
            }
			$arr = array();
            if ($this->user) {
                $par = array($this->user);
            } else {
                $par = array();
            }
			if ($stmt->execute($par)) {
			  while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($arr, new FeedItem($this->db, $row->feed_item_id, $row->username, $row->text, $row->parnt));
			  }
			}
			return $arr;
		} catch (PDOException $e) {
			return array();
		}
	}
	
    public function add_feed($user, $text, $parent = null) {
        try {
            $pr = (($parent == null) ? null : $parent->get_id());
			$stm = $this->db->prepare("INSERT INTO feed(username,text,parnt) VALUES (?, ?, ?)");
			$stm->execute(array($user, $text, $pr));
			return new FeedItem($this->db, $this->db->lastInsertId(), $user, $text, $pr);
		} catch (PDOException $e) {
		}
        return null;
    }
	
}

?>
