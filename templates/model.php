<?php
namespace Template;

abstract class Template {
	public function render() {
		$self_page = filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_ENCODED);
	}
}

class EmptyTemplate extends Template {
	public function render() {
		parent::render();
	}
}

?>
