<?php
namespace Template;

class PageInfo {
	public $icon;
	public $href;
	public $title;

	public function __construct($icon, $href, $title) {
		$this->icon = $icon;
		$this->href = $href;
		$this->title = $title;
	}
}

class NestedMenu {
	public $title; 
	public $entries;
	public function __construct($n, $en) {
		$this->title = $n;
		$this->entries = $en;
	}
}

class MenuBox {
	public $pages;
	public $right_menu;
	public function __construct($pages, $right_menu) {
		$this->pages = $pages;
		$this->right_menu = $right_menu;
	}
}

?>
