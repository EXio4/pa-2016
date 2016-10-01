<?php
namespace Feed;

class FeedItem {
	var $username;
	var $text;
	public function __construct($u, $t) {
		$this->username = $u;
		$this->text     = $t;
	}
	public function echo_item() {
		 echo "<div class=\"event\">\n\t";
		 echo "<div class=\"label\"><i class=\"comment icon\"></i></div>";
		 echo "<div class=\"content\">\n\t<div class=\"summary\">\n\t";
		 echo "<div class=\"user\">";
		 echo (filter_var($this->username, FILTER_SANITIZE_SPECIAL_CHARS));
		 echo  "</div> - ";
		 echo (filter_var($this->text, FILTER_SANITIZE_SPECIAL_CHARS));
	//			<div class="date">Today</div>
		 echo "</div></div></div>\n";
	}
}

function publish_message($text) { 
	
}

function print_feed() {
	echo "<div class=\"ui feed\">";
	foreach($_SESSION["test_feed"] as $e) {
		$e->echo_item();	
	}
	echo "</div>";
}

function init() {	
	if (!isset($_SESSION["test_feed"])) {
			$_SESSION["test_feed"] = array(new FeedItem("Admin", "This is an example message"),
											 new FeedItem("User1", "Fancy site."),
											 new FeedItem("exio4", "I dislike PHP")
											 );
		                                 
		                                 
	}
}
	
?>
