<?php
namespace Template;

require_once "model.php";

class PageNotFound extends Template {
	public function __construct() {
	}
	public function render() {
		parent::render();
?>


<div class="ui raised container segment">
        <h1 class="ui header">:( 404 - Page not found</h1>
        <h4 class="ui">Are you sure you are on the right page?</h4>
</div>



<?php
	}
}
	
