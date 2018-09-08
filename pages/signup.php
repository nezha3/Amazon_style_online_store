<?php
/************************************************
File:		  signup.php
Author:		Oliver Chi
Purpose:	Sign up an account
**************************************************/

if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
  $uri = 'https://';
} else {
  $uri = 'http://';
}
$uri .= $_SERVER['HTTP_HOST'];

// Define variables and set to empty values
$nameErr = $emailErr = $passwordErr = $confirmErr = "";//error message for form input
$name = $email = $password = $confirm = "";//input values

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
return $data;
}

// On submitting form below function will execute.
if(isset($_POST['submit'])){
  if (empty($_POST["name"])) {
    $nameError = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
    $nameError = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["email"])) {
    $emailError = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address syntax is valid or not
    if (!preg_match("/([w-]+@[w-]+.[w-]+)/",$email)) {
    $emailError = "Invalid email format";
    }
  }

  if (empty($_POST["password"])) {
    $passwordError = "Password is required";
  } else {
    $password = test_input($_POST["password"]);
    // check name only contains letters and whitespace
    if (!preg_match("/([a-zA-Z0-9])/",$password)) {
    $passwordError = "Only letters and numbers allowed";
    }
  }

  if (empty($_POST["confirm"])) {
    $confirmError = "Repeated password is required";
  } else {
    $confirm = test_input($_POST["confirm"]);
    // check name only contains letters and whitespace
    if (test_input($_POST["password"]) != test_input($_POST["confirm"])) {
    $passwordError = "Two passwords did't match";
    }
  }
} else {
  echo "all matched";
}

$content = <<<HTML
  <div class="signup"><!-- signup container -->
    <div class="signup-row"><!-- signup container row -->
      <div class="signup-text"><!-- signup display text -->

      </div>
      <div class="signup-form"><!-- login form -->
          <form id="signup_submit" method="POST" action="./signup.php">
            <h2>Create Account</h2>
            <div class="form-group show-progress">

            </div>
            <div class="form-group">
              <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name...">
              <span class="error"><?php echo $nameErr;?></span>
              <div class="name-error error"></div>
            </div>
            <div class="form-group">
              <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email...">
              <span class="error"><?php echo $emailErr;?></span>
              <div class="email-error error"></div>
            </div>
            <div class="form-group">
              <input type="password" name="password" id="password" class="form-control" placeholder="Choose Password...">
              <span class="error"><?php echo $passwordErr;?></span>
              <div class="password-error error"></div>
            </div>
            <div class="form-group">
              <input type="password" name="confirm" id="confirm" class="form-control" placeholder="Confirm Password...">
              <span class="error"><?php echo $confirmErr;?></span>
              <div class="confirm-error error"></div>
            </div>
            <div class="form-group">
              <input type="submit" name="submit" value="Create your account">
            </div>
            <div class="form-group">
              <a href="./login.php" id="login">Already have an account?</a>
            </div>
        </form>
      </div>

    </div>
  </div>
HTML;
?>

<?php

  require("../libcommon.php");
	require("layout.php");

  echo $header;

  echo $content;

  echo $footer;

  exit;
?>
