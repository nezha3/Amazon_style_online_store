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
  echo "now register";
}

$db->close();//close connection of database
?>
