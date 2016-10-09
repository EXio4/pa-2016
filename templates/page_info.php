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

?>
