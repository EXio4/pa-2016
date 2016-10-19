<?php
namespace Template;

require_once "model.php";

require_once "feed.php";

class Profile extends Template {
	private $user;
	private $feed;
	public function __construct($user,$feed) {
		$this->user = $user;
		$this->feed = $feed;
	}
	public function render() {
		parent::render();
?>

<div class="ui raised container segment">
	<h5 class="ui header">MiWi - <?php echo $this->user->get_username(); ?> </h5>
</div>


<?php
	$fd = new Feed($this->user, $this->feed->get_items()); $fd->render();
?>


<?php
	}
}
	
