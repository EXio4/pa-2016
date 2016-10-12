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
foreach ($this->feeds as $feed_item) {
		$fi = new FeedItem($feed_item); $fi->render();
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
	
