<?php
namespace Template;

require_once "model.php";

require_once "feed_item.php";

class Feed extends Template {
	private $feeds;
	private $own;
	private $gen;
	public function __construct($own, $feeds,$gen = false) {
		$this->own   = $own;
		$this->feeds = $feeds;
		$this->gen = $gen;
	}
	public function render() {
		parent::render();
?>

<div class="ui feed">
<?php
foreach ($this->feeds as $feed_item) {
		$fi = new FeedItem($this->own, $feed_item, true, $this->gen); $fi->render();
}
if (empty($this->feeds)) {
	?>
		<h1 class="ui header">:( No messages</h1>
	<?php
}
?>      
</div>
<?php
	}
}
	
