<?php

/************************************************
File:		  account.php
Author:		Oliver Chi
Purpose:	account management for register user
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

echo "Account Management";

$db->close();//close connection of database

?>
