<?php

/************************************************
File:		  user.php
Author:		Oliver Chi
Purpose:	Login/Logout/Signup the Account
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

/* Actions */

// POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $password = $_POST["password"];

  //avoid sql injection attack
  //escape key words in Sqlite3
  $email=SQLite3::escapeString($email);
  $password=SQLite3::escapeString($password);

  $result = $db->query("SELECT * FROM user WHERE user.email = '".$email."' AND user.key = '".$password."'");//sql
  $user = $result->fetchArray();

  if ($user == NULL){
    pageCookie("login_0");// locate login page again
    goHome();
  } else {
    userCookie($email); // set registeruser cookie
    nameCookie($user['name']); // set name cookie
    pageCookie("account");// locate home page of account management
  }

// GET
} else {
  if (array_key_exists('action', $_GET)) {//if require actions
    $action = strval($_GET['action']);

    // LOGIN
    if ($action == "login"){//login action
      if (getPage()!="login_0"){
        pageCookie("login");
      }
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
                            <a href='#' onclick='signup()' id='signup'>Doesn't have an account?</a>
                          </div>
                      </form>
                    </div>
                  </div>
                </div>";
      echo $js;
      echo $login;

    // LOGOUT
    } elseif ($action == "logout"){//logout action
      setcookie("registeruser", "", time() - 36000, "/"); // delete user cookie
      setcookie("name", "", time() - 36000, "/"); // delete name cookie
      pageCookie("home");

    // SIGNUP
    } elseif ($action == "signup"){//signup action
      pageCookie("signup");

      $js = "<script>
      $(function () {
        $('#register_form').on('submit', function (e) {<!-- AJAX form submission -->
          // validate and process form
          $('.error_msg').empty();//empty error message
          var email = $('#email').val();
          var key = $('#password').val();
          var key2 = $('#confirm').val();
          var name = $('#name').val();
          if (key != key2) $('.error_msg').text('Please Confirm Your Password Again: not equal!');
          if (!(matchExpression(email).email)) $('.error_msg').text('Incorret Email Format!');
          if (!(matchExpression(key).onlyMixOfAlphaNumeric)) $('.error_msg').text('Incorret Password Format: Password Only Contains Letters and Numbers!');
          if (!(matchExpression(name).onlyLetters)) $('.error_msg').text('Incorret Name Format: Name Only Contains Letters!');
          if ($('.error_msg').text().length == 0){//no error
            register(email, key, name);//submit register request
          } else {
            e.preventDefault();
          }
        });
      });</script>";

      $signup = "<div class='signup-form'><!-- Sign Up Form -->
                        <form id='register_form'>
                          <h2>Create Account</h2>
                          <div class='form-group show-progress'>
                            <p class='error_msg' ></p>
                          </div>
                          <div class='form-group'>
                            <input type='text' name='name' id='name' class='form-control' placeholder='Enter Name...'>
                            <br>
                          </div>
                          <div class='form-group'>
                            <input type='email' name='email' id='email' class='form-control' placeholder='Enter Email...'>
                            <br>
                          </div>
                          <div class='form-group'>
                            <input type='password' name='password' id='password' class='form-control' placeholder='Choose Password...'>
                            <br>
                          </div>
                          <div class='form-group'>
                            <input type='password' name='confirm' id='confirm' class='form-control' placeholder='Confirm Password...'>
                            <br>
                          </div>
                          <div class='form-group'>
                            <input id='register_button' type='submit' value='Create your account'>
                          </div>
                          <div class='form-group'>
                            <a href='#' id='login' onclick='login()'>Already have an account?</a>
                          </div>
                        </form>
                  </div>";
      echo $js;
      echo $signup;
    }

  }

}

$db->close();//close connection of database

?>
