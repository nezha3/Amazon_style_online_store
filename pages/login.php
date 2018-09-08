<?php

/************************************************
File:		  login.php
Author:		Oliver Chi
Purpose:	Login account
**************************************************/

$content = <<<HTML
  <div class="login"><!-- login container -->
    <div class="login-row"><!-- login container row -->
      <div class="login-text"><!-- login display text -->
        <h3>Big Bear is better than Amazon!</h3><hr>
        <p>It is always free. No membership fee for ever. It is never too late to join Bear family. Cheer up guys ):</p>
      </div>
      <div class="login-form"><!-- login form -->
          <form id="login_submit" action="./user.php" method="post">
            <h2>Login To Your Account</h2>
            <div class="form-group show-progress">

            </div>
            <div class="form-group">
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email/User Name...">
              <div class="email-error error"></div>
            </div>
            <div class="form-group">
              <input type="password" name="password" id="password" class="form-control" placeholder="Password...">
              <div class="password-error error"></div>
            </div>
            <div class="form-group">
              <input type="submit" value="Login your account">
            </div>
            <div class="form-group">
              <a href="./signup.php" id="signup">Doesn't have an account?</a>
            </div>
        </form>
      </div>
    </div>
  </div>
HTML;

?>

<?php
	if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
		$uri = 'https://';
	} else {
		$uri = 'http://';
	}
	$uri .= $_SERVER['HTTP_HOST'];

  require("../libcommon.php");
	require("layout.php");

  echo $header;

	echo $content;

  echo $footer;

	exit;
?>
