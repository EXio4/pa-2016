<?php
namespace Template;

require_once "model.php";

require_once "feed.php";

class Index extends Template {
	private $feed;
	public function __construct($feed) {
		$this->feed = $feed;
	}
	public function render() {
		parent::render();
?>


<div class="ui raised container segment">
	<h5 class="ui header">MiWi - Main News</h5>
</div>

<?php
	$fd = new Feed($this->feed->get_items()); $fd->render();
?>

<?php
	}
}
	
