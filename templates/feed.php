<?php
namespace Template;

require_once "model.php";

require_once "feed_item.php";

class Feed extends Template {
	private $feeds;
	private $own;
	private $gen;
	private $page;
	public function __construct($own, $feeds, $page_num, $gen = false) {
		$this->own   = $own;
		$this->feeds = $feeds;
		$this->gen = $gen;
		$this->page = $page_num;
	}
	public function render() {
		parent::render();
?>

<div class="ui yellow segment">
<?php
foreach ($this->feeds as $feed_item) {
		$fi = new FeedItem($this->own, $feed_item, true, $this->gen); $fi->render();
}
if (empty($this->feeds)) {
	?>
		<h1 class="ui header">:( No messages in this page</h1>
	<?php
}
?>
	<div class="ui clearing black segment">
		<?php if ($this->page > 1) { ?>
		<a href="<?php echo $this->self_page; ?>?page=<?php echo ($this->page - 1); ?>" class="ui left floated button">
			Previous
		</a>
		<?php } ?>
		<a href="<?php echo $this->self_page; ?>?page=<?php echo ($this->page + 1); ?>" class="ui right floated button">
			Next
		</a>

	</div>
</div>
<?php
	}
}
	
