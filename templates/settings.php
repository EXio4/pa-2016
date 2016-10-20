<?php
namespace Template;

require_once "model.php";

class Settings extends Template {
	private $msg;
	public function __construct($msg) {
		$this->msg = $msg;
	}
	public function render() {
		parent::render();
?>


<div class="ui segments">
	<div class="ui purple segment">
		<h1 class="ui header">Settings</h1>
	</div>
	<div class="ui red segment">
		<form class="ui form <?php if ($this->msg) echo "error";?>"method="post" action="settings.php" name="pwd_change">
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
			<div class="ui error message">
				<div class="header"><?php echo $this->msg ?></div>
			</div>
		</form>
	</div>
</div>



<?php
	}
}
	
