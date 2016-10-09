<?php
namespace Template;

require_once "model.php";

require_once "feed_item.php";

class Feed extends Template {
	private $feeds;
	public function __construct($feeds) {
		$this->feeds = $feeds;
	}
	public function render() {
		parent::render();
?>

<div class="ui feed">
<?php
foreach ($this->feed as $feed_item) {
		new FeedItem($feed_item).render();
}
?>      
</div>
<?php
	}
}
	
