<?php
namespace Template;

require_once "model.php";
require_once "feed_item.php";


class DeleteTweet extends Template {
	private $error;
	private $usr;
	private $parnt;
	public function __construct($usr, $parnt, $error = false) {
		$this->error = $error;
		$this->parnt = $parnt;
		$this->usr   = $usr;
	}
	public function render() {
		parent::render();
?>

      
<form name="delete_tweet" class="ui form <?php echo ($this->error ? "error" : ""); ?>" method="POST" action="delete_tweet.php?id=<?php echo $this->parnt->get_id(); ?>">
	<label></label>
	<a class="ui left ribbon blue label">
		Remove Item
	</a>
	
	<?php
	
		$f = new FeedItem($this->usr, $this->parnt, false, false);
		$f->render();
	
	?>
	
	<div class="field">
		<label>Captcha</label>
		<img class="ui small image" src="xtra/rdnimg.php">
		<input name="captcha" type="text">
	</div>
	
	<div class="ui error message">
		<div class="header">Error</div>
		<p> <?php if ($this->error) { echo $this->error; } ?> </p>
	</div>

	<button class="ui red button">
		Remove
	</button>
	
</form>


<?php
	}
}
	
