<?php
namespace Template;

require_once "page_info.php";

require_once "model.php";

class Login extends Template {
	private $error;
	public function __construct($ret_site_enc, $error = false) {
		$this->ret_site_enc = $ret_site_enc;
		$this->error = $error;
	}
	public function render() {
		parent::render();
?>
      
<form name="login_form_main" class="ui form <?php echo ($this->error ? "error" : ""); ?>" method="POST" action="login.php?red=<?php echo $this->ret_site_enc; ?>">
	<div class="field">
		<label>Username</label>
		<input name="username" type="text">
	</div>
	<div class="field">
		<label>Password</label>
		<input name="password" type="password">
	</div>
	<div class="field">
		<label>Captcha</label>
		<img class="ui small image" src="xtra/rdnimg.php">
		<input name="captcha" type="text">
	</div>
	
	<div class="ui error message">
		<div class="header">Login Error</div>
		<p> <?php if ($this->error) { echo $this->error; } ?> </p>
	</div>

	<button class="ui primary button">
		Login
	</button>
	
</form>

<script>
$("form[name='login_form_main']")
  .form({
    on: 'blur',
    inline: true,
    fields: {
      username: {
        identifier  : 'username',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter an username'
          }
        ]
      },
      password: {
        identifier  : 'password',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please enter a password'
          }
        ]
      },
      captcha: {
        identifier  : 'captcha',
        rules: [
          {
            type   : 'empty',
            prompt : 'Please type down the text on the image'
          }
        ]
      }
    }
  })
;
</script>


<?php
	}
}
	
