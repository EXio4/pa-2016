<?php
namespace Template;

require_once "page_info.php";

require_once "model.php";

class MenuItem extends Template {
	private $page;
	private $important;
	public function __construct($page, $important = false) {
		$this->page = $page;
		$this->important = $important;
	}
	public function render() {
		parent::render();
?>

<a class="item" href="<?php echo $this->page->href ?>">
        <i class="<?php echo $this->page->icon ?> icon"></i><?php echo $this->page->title ?>
</a>

<?php
	}
}
	
