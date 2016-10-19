<?php
namespace Template;

require_once "model.php";

class FeedItem extends Template {
	private $item;
	private $par;
	private $inicial;
	private $own;
	public function __construct($own, $item,$inicial=true,$rec = true) {
		$this->own     = $own;
		$this->inicial = $inicial;
		$this->item = $item;
		if ($rec) {
			$this->par = $item->get_parent();
			if ($this->par != null) {
				$this->par = new FeedItem($own, $this->par, false, true);
			}
		}
	}
	public function render() {
		parent::render();
?>

<?php
if ($this->inicial) { 
?>
<div class="ui purple segment">
<?php
}

if ($this->par) $this->par->render();
?>

<div class="ui <?php if ($this->inicial) { echo "red"; } else { echo "pink"; } ?> segment">
	<a class="ui blue label" href="profile.php?user=<?php echo $this->item->get_username() ?>">
		<i class="comment icon"></i>
		<?php echo (filter_var($this->item->get_username(), FILTER_SANITIZE_SPECIAL_CHARS)); ?>
	</a>
	<?php
	if ($this->own != null &&
		$this->own->get_username() == $this->item->get_username()) {
	?>
	<a class="ui red label" href="delete_tweet.php?id=<?php echo $this->item->get_id(); ?>">
		<i class="delete icon"></i>
	</a>
	<?php
	}
	?>
	<a class="ui grey label"  href="post.php?parent=<?php echo $this->item->get_id(); ?>">
		<?php echo (filter_var($this->item->get_text(), FILTER_SANITIZE_SPECIAL_CHARS)); ?>
	</a>
</div>
<?php
if ($this->inicial) { 
?>
</div>
<?php
}


	}
}
	
