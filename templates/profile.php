<?php
namespace Template;

require_once "model.php";

require_once "feed.php";

class Profile extends Template {
	private $user;
	private $feed;
	private $own_profile;
	public function __construct($user,$own_profile,$feed) {
		$this->user = $user;
		$this->own_profile = $own_profile;
		$this->feed = $feed;
	}
	public function render() {
		parent::render();
?>

<div class="ui raised container segment">
	<h5 class="ui header">MiWi - <?php echo $this->user->get_username(); ?> </h5>
</div>


<?php
	$fd = new Feed($this->feed->get_items()); $fd->render();
	
	if ($this->own_profile) {
?>

<form class="ui fluid action input" method="POST" action="profile.php">
  <input name="msg" type="text" placeholder="what's up?">
  <div class="ui primary button">Send</div>
</form>

<?php
	}
?>



<?php
	}
}
	
