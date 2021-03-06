<?php

/************************************************
File:		  register.php
Author:		Oliver Chi
Purpose:	Register New Account
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

/* Actions */
if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $email = strval( $_GET["email"] );
  $key = strval( $_GET["key"] );
  $name = strval( $_GET["name"] );
  $id = getNextID("user");

  //avoid sql injection attack
  //escape key words in Sqlite3
  $email=SQLite3::escapeString($email);
  $key=SQLite3::escapeString($key);
  $name=SQLite3::escapeString($name);

  if ( insertUser($id, $email, $key, $name) ){
    userCookie($email); // set registeruser cookie
    nameCookie($name); // set name cookie
    pageCookie("account");// locate home page of account management
  } else {
    pageCookie("signup");// locate signup page again
    goHome();
  }
}

$db->close();//close connection of database
?>
