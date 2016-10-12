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
				?>
				<div class="ui simple dropdown item">
						<i class="child icon"></i><?php echo $this->login_info->get_username(); ?> <i class="dropdown icon"></i>
					<div class="menu">
			<?php
				$menu = new MenuItem(new PageInfo("user" , "profile.php", "Profile")); $menu->render();
				$menu = new MenuItem(new PageInfo("settings", "settings.php", "Settings")); $menu->render();
				$menu = new MenuItem(new PageInfo("close", $this->self_page . "?logout=1", "Logout")); $menu->render();
			?>
					</div>
				</div>
			<?php
			} else {
				$menu = new MenuItem(new PageInfo("user", "login.php?red=" . $this->self_page_enc, "Login"), true); $menu->render();
			}
		?>
	</div>
  </div>
</div>


<?php
	}
}
	
