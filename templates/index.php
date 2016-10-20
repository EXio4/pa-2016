<?php
namespace Template;

require_once "model.php";

require_once "feed.php";

class Index extends Template {
	private $feed;
	private $own;
	private $page;
	public function __construct($own, $feed,$page) {
		$this->feed = $feed;
		$this->own = $own;
		$this->page = $page;
	}
	public function render() {
		parent::render();
?>


<div class="ui raised container segment">
	<h5 class="ui header">MiWi - Main News</h5>
</div>

<?php
	$fd = new Feed($this->own, $this->feed->get_items($this->page), $this->page); $fd->render();
?>

<?php
	}
}
	
