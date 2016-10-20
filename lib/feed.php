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
    public function kill($curr_usr) {
        if ($curr_usr->username == $this->username) return;
        try {
			$parnt = $this->parnt;
            $pr = (($parnt == null) ? null : $parnt->get_id());
			$stm = $this->db->prepare("DELETE FROM feed where feed_item_id = ?");
			$stm->execute(array($this->item_id));
			return;
		} catch (PDOException $e) {
		}
        return null;        
    }
    public function get_parent() {
        if ($this->parnt == null) return null;
        else {
            $fm = new FeedManager($this->db);
            $xid = $fm->get_id($this->parnt);
            if ($xid == null) {
				$xid = new FeedItem($this->db, -1, "#deleted", "Deleted message", null);
			}
			return $xid;
        }
    }
    
}

class FeedList {
    private $db;
	private $user; /* null represents global feed */
	
	public function __construct($db, $user = null) {
		$this->db = $db;
		$this->user = $user;
	}

	public function get_items($page = 1) {
		try {
            if ($this->user) {
                $stmt = $this->db->prepare("SELECT feed_item_id,username,text,parnt FROM feed where username = ? limit ?,?");
            } else {
                $stmt = $this->db->prepare("SELECT feed_item_id,username,text,parnt FROM feed ORDER BY feed_item_id DESC LIMIT ?,?;");
            }
			$arr = array();
            if ($this->user) {
                $par = array($this->user->get_username());
            } else {
                $par = array();
            }
            $par[] = ($page - 1) * 20;
            $par[] = 20; // tweets per page

			if ($stmt->execute($par)) {
			  while ($row = $stmt->fetch(\PDO::FETCH_OBJ)) {
				array_push($arr, new FeedItem($this->db, $row->feed_item_id, $row->username, $row->text, $row->parnt));
			  }
			}
			return $arr;
		} catch (PDOException $e) {
			echo $e;
			return array();
		}
	}
    
    public function add_feed($text, $parent = null) {
        try {
            $pr = (($parent == null) ? null : $parent->get_id());
			$stm = $this->db->prepare("INSERT INTO feed(username,text,parnt) VALUES (?, ?, ?)");
			$stm->execute(array($this->user->get_username(), $text, $pr));
			return new FeedItem($this->db, $this->db->lastInsertId(), $this->user->get_username(), $text, $pr);
		} catch (PDOException $e) {
		}
        return null;
    }
	    
}

class FeedManager {
	private $db;
	
	public function __construct($db) {
		$this->db = $db;
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

    public function get_feed($user = null) {
        return new FeedList($this->db, $user);
    }
    public function get_id($xid) {
        try {
            $stmt = $this->db->prepare("SELECT feed_item_id,username,text,parnt FROM feed where feed_item_id = ?");
            
            if ($stmt->execute(array($xid))) {
              while ($row = $stmt->fetch(\PDO::FETCH_OBJ)) {
                return new FeedItem($this->db, $row->feed_item_id, $row->username, $row->text, $row->parnt);
              }
            }

            return null;
        } catch (PDOException $e) {
            return null;
        }
    }
}

?>
