<?php
namespace Template;

require_once "model.php";

class FeedItem extends Template {
	private $item;
	public function __construct($item) {
		$this->item = $item;
	}
	public function render() {
		parent::render();
?>

<div class="event">
	<div class="label"><i class="comment icon"></i></div>
	<div class="content">
	<div class="summary\">
		<div class="user">
		 <?php echo (filter_var($this->item->get_username(), FILTER_SANITIZE_SPECIAL_CHARS)); ?>
		</div> - <?php echo (filter_var($this->item->get_text(), FILTER_SANITIZE_SPECIAL_CHARS)); ?>
	</div>
	</div>
</div>

<?php
	}
}
	
