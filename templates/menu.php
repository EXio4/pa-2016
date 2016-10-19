<?php
namespace Template;

require_once "page_info.php";

require_once "model.php";
require_once "menu_item.php";

class Menu extends Template {
	private $title;
	private $pages;
	private $login_info;
	public function __construct($title, $pages, $login_info) {
		$this->title = $title;
		$this->minfo = $pages;
		$this->login_info = $login_info;
	}
	public function render() {
		parent::render();
?>

<div class="ui attached stackable menu">
  <div class="ui container">
	<?php 
		foreach ($this->minfo->pages as $page) {
			$menu = new MenuItem($page, ($page->title == $this->title)); $menu->render();
		}
	?>
	<div class="right menu">
		<?php

			if (empty($this->minfo->right_menu->entries)) {
				$menu = new MenuItem($this->minfo->right_menu->title, true); $menu->render();
			} else {
				?>
				<div class="ui simple dropdown item">
						<i class="child icon"></i><?php echo $this->minfo->right_menu->title->title ?> <i class="dropdown icon"></i>
					<div class="menu">
						<?php	
						foreach ($this->minfo->right_menu->entries as $page) {
							$menu = new MenuItem($page, ($page->title == $this->title)); $menu->render();
						}
						?>
					</div>
				</div>
				<?php
			}				
		?>
	</div>
  </div>
</div>


<?php
	}
}
	
