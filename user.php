<?php

/************************************************
File:		  user.php
Author:		Oliver Chi
Purpose:	register/login account in this website
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

/* Actions */
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];
  $result = $db->query("SELECT * FROM user WHERE user.email = '".$email."' AND user.key = '".$password."'");//sql
  $user = $result->fetchArray();
  if ($user == NULL){
    pageCookie("login");// locate login page
    goHome();
  } else {
    userCookie($email); // set registeruser cookie
    pageCookie("account");// locate home page of account management
  }
} else {
  if (array_key_exists('action', $_GET)) {//if require actions
    $action = strval($_GET['action']);
    if ($action == "login"){//login action
      pageCookie("login");
      $js = "<script>
      $(function () {
        $('#login_submit').on('submit', function (e) {<!-- AJAX form submission -->
          $.ajax({
            type: 'POST',
            url: 'user.php',
            data: $('form').serialize(),
            success: function(data) {
              window.location = 'index.php';
            }
          });
        });
      });</script>";//for test: //loginAccount($('#email').val(), $('#password').val());//e.preventDefault();<!-- stop refresh page -->//action='user.php' method='post'//alert('form was submitted');//$('form').unbind('submit').submit();

      $login = "<div class='login'><!-- login container -->
                  <div class='login-row'><!-- login container row -->
                    <div class='login-text'><!-- login display text -->
                      <h3>Big Bear is better than Amazon!</h3><hr>
                      <p>It is always free. No membership fee for ever. It is never too late to join Bear family. Cheer up guys ):</p>
                    </div>
                    <div class='login-form'><!-- login form -->
                        <form id='login_submit' >
                          <h2>Login To Your Account</h2>
                          <div class='form-group'>
                            <p id='loginMsg'>Mismatched in inputs, please input correct email and password!</p>
                          </div>
                          <div class='form-group'>
                            <input type='email' name='email' id='email' class='form-control' placeholder='Enter Email/User Name...'>
                            <div class='email-error error'></div>
                          </div>
                          <div class='form-group'>
                            <input type='password' name='password' id='password' class='form-control' placeholder='Password...'>
                            <div class='password-error error'></div>
                          </div>
                          <div class='form-group'>
                            <input type='submit' value='Login your account'>
                          </div>
                          <div class='form-group'>
                            <a href='#' onclick='register()' id='signup'>Doesn't have an account?</a>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>";
      echo $js;
      echo $login;
    } elseif ($action == "logout"){//logout action
      setcookie("registeruser", "", time() - 36000, "/"); // delete user cookie
      pageCookie("home");
    } elseif ($action == "register"){//register action
      // Define variables and set to empty values
      $nameErr = ""; $emailErr = ""; $passwordErr = ""; $confirmErr = "";//error message for form input
      $name = ""; $email = ""; $password = ""; $confirm = "";//input values
      $register = "<div class='signup'><!-- signup container -->
                      <div class='signup-row'><!-- signup container row -->
                        <div class='signup-text'><!-- signup display text -->

                        </div>
                        <div class='signup-form'><!-- login form -->
                            <form id='signup_submit' method='POST' action='./signup.php'>
                              <h2>Create Account</h2>
                              <div class='form-group show-progress'>

                              </div>
                              <div class='form-group'>
                                <input type='text' name='name' id='name' class='form-control' placeholder='Enter Name...'>
                                <span class='error'><?php echo $nameErr;?></span>
                                <div class='name-error error'></div>
                              </div>
                              <div class='form-group'>
                                <input type='email' name='email' id='email' class='form-control' placeholder='Enter Email...'>
                                <span class='error'><?php echo $emailErr;?></span>
                                <div class='email-error error'></div>
                              </div>
                              <div class='form-group'>
                                <input type='password' name='password' id='password' class='form-control' placeholder='Choose Password...'>
                                <span class='error'><?php echo $passwordErr;?></span>
                                <div class='password-error error'></div>
                              </div>
                              <div class='form-group'>
                                <input type='password' name='confirm' id='confirm' class='form-control' placeholder='Confirm Password...'>
                                <span class='error'><?php echo $confirmErr;?></span>
                                <div class='confirm-error error'></div>
                              </div>
                              <div class='form-group'>
                                <input type='submit' name='submit' value='Create your account'>
                              </div>
                              <div class='form-group'>
                                <a href='#' id='login' onclick='login()'>Already have an account?</a>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>";
        echo $register;
    } else {

    }
  }
}

$db->close();//close connection of database

?>
