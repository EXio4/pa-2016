<?php
namespace Template;

abstract class Template {
	protected $self_page;
	protected $self_page_enc;
	public function render() {
		$this->self_page     = $_SERVER['PHP_SELF'];
		$this->self_page_enc = filter_var($_SERVER['PHP_SELF'], FILTER_SANITIZE_ENCODED);
	}
}

class EmptyTemplate extends Template {
	public function render() {
		parent::render();
	}
}

?>
