<?php
namespace Template;

require_once "model.php";

require_once "feed.php";

class FeedWrapper extends Template {
	private $feed;
	public function __construct($feed) {
		$this->feed = $feed;
	}
	public function render() {
		parent::render();
?>

<?php
	new Feed($feed->get_items()).render();
?>

<?php
	}
}
	