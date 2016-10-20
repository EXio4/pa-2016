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
	<title><?php echo $this->title; ?> - MiWi</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="s-ui/semantic.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="s-ui/semantic.min.js"></script>
</head>

<body>
	
<?php $menu = new Menu($this->title,$this->pages,$this->login_info); $menu->render(); ?>

<div class="ui container">

<?php $this->body_template->render(); ?>


<div class="ui inverted footer segment">
	
	<a class="ui purple right ribbon blue label" href="http://github.com/EXio4/pa-2016">
		<i class="terminal icon"></i>
		Code
	</a>
	<div>
	<h5 class="ui inverted header">Programacion Avanzada TP3</h5>
	<p class="ui inverted">Grupo 7 / Esteban Ibraim Ruiz Moreno</p>
	</div>
</div>

</div>

</body>

</html>



<?php
	}
}
	
