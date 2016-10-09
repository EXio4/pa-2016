<?php
namespace Template;

require_once "page_info.php";

require_once "model.php";
require_once "menu.php";

class Page extends Template {
	private $title;
	private $pages;
	private $login_info;
	private $body_template;
	public function __construct($title, $pages, $login_info, $body_template) {
		$this->title = $title;
		$this->pages = $pages;
		$this->login_info = $login_info;
		$this->body_template = $body_template;
	}
	public function render() {
		parent::render();
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title><?php $this->title ?></title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="s-ui/semantic.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="s-ui/semantic.min.js"></script>
</head>

<body>
	
<?php $menu = new Menu($this->title,$this->pages,$this->login_info); $menu->render(); ?>

<div class="ui container">
<div class="ui raised container segment">
	<h3 class="ui header">Programacion Avanzada TP3</h3>
	<p class="ui"></p>
</div>

<?php $this->body_template->render(); ?>

</div>

</body>

</html>



<?php
	}
}
	
