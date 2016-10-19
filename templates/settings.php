<?php
namespace Template;

require_once "model.php";

class Settings extends Template {
	public function __construct() {
	}
	public function render() {
		parent::render();
?>


<div class="ui segments">
	<div class="ui red segment">
		<form method="post" action="settings.php" name="pwd_change">
			<div class="ui action input">
				<input name="pwd_old" type="password" placeholder="Old password...">
			</div>
			<div class="ui action input">
				<input name="pwd_curr" type="password" placeholder="New password...">
			</div>
			<div class="ui action input">
				<input name="pwd_curr_2" type="password" placeholder="Repeat new password...">
			</div>
			<button class="ui primary submit button" type="submit">
				Change Password
			</button>
		</form>
	</div>
	<div class="ui red segment">
		<form method="post" action="delete_acc.php" name="pwd_change">
			<button class="ui submit red button" type="submit">
				Delete account
			</button>
		</form>
	</div>
</div>



<?php
	}
}
	
