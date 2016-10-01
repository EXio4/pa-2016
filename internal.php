<?php
	$title = "Internal";
	include "template_header.php";

	if(UserManagement\is_logged()) {
		return false;
	}
?>


<div class="ui raised very padded text container segment">
  <h1 class="ui header">This is an internal page, are you sure you are on the right page?</h1>
</div>


<?php
	include "template_final.php";
	return true;
?>
