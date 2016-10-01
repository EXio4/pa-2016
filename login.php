<?php $title = "Login";
      include "template_header.php"; ?>

<?php

	$return_site = "index.php";
	if (isset($_GET["red"])) {
		$return_site = $_GET["red"];
	}
	$return_site_enc = filter_var($return_site, FILTER_SANITIZE_ENCODED);

	if ((isset($_POST["username"])) && (isset($_POST["password"]))) {
		$user = $_POST["username"];
		$pwd  = $_POST["password"];
		$login_error = !(\UserManagement\login($user, $pwd));
	}
	if (\UserManagement\is_logged()) {
		redirect($return_site);
	}
	
?> 
      
<form name="login_form_main" class="ui form <?php echo ($login_error ? "error" : ""); ?>" method="POST" action="login.php?red=<?php echo $return_site_enc; ?>">
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
		<input name="captcha" type="text">
	</div>
	
	<div class="ui error message">
		<div class="header">Login Error</div>
		<p>Invalid username or password, try again.</p>
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

<?php include "template_final.php"; ?>
