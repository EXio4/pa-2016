<?php $title = "Home";
      include "template_header.php"; ?>
      
<?php

	include "feed.php";
if (\UserManagement\is_logged()) {
	include "msg_input.php";
} else {
	include "login_needed.php";
}

?>



<?php include "template_final.php"; ?>
