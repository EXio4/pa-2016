<?php
namespace Template;

require_once "model.php";

class Post extends Template {
	private $parnt;
	private $usr;
	public function __construct($parent,$usr) {
		$this->parnt = $parent;
		$this->usr   = $usr;
	}
	public function render() {
		parent::render();
?>

<?php
if ($this->parnt) {
?>

<div class="ui blue segment">
	<div class="ui feed">
	<?php
		$f = new FeedItem($this->usr, $this->parnt); $f->render();
	?>
	</div>

<?php
}
?>

<?php
if ($this->usr) {
?>
<div class="ui purple segment">
	<form class="ui fluid action input" method="POST" action="post.php<?php if ($this->parnt) echo("?parent=" . $this->parnt->get_id()); ?>">
	  <input name="msg" type="text" placeholder="what's up?">
	  <button class="ui primary button" type="submit">Send</button>
	</form>
</div>
<?php
}
?>

<?php
if ($this->parnt) {
?>
</div>
<?php
}
?>

<?php
	}
}
	
