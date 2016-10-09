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
		$this->pages = $pages;
		$this->login_info = $login_info;
	}
	public function render() {
		parent::render();
?>

<div class="ui attached stackable menu">
  <div class="ui container">
	<?php 
		foreach ($this->pages as $page) {
			$menu = new MenuItem($page, ($page->title == $this->title)); $menu->render();
		}
	?>
	<div class="right menu">
		<?php
			if ($this->login_info) {
				$menu = new MenuItem(new PageInfo("user", "profile.php", "Profile")); $menu->render();
				$menu = new MenuItem(new PageInfo("exit", $self_page . "?logout=1", "Logout")); $menu->render();
			} else {
				$menu = new MenuItem(new PageInfo("user", "login.php?red=" . $self_page, "Login"), true); $menu->render();
			}
		?>
	</div>
  </div>
</div>


<?php
	}
}
	
