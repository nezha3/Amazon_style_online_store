<?php

/************************************************
File:		  libcommon.php
Author:		Oliver Chi
Purpose:	Load database and check cookies
**************************************************/

// Get globaL variables
$dir = dirname(__FILE__);



// Check cookies




// Load Database
$db = new SQLite3('./assets/db/db.sq3', SQLITE3_OPEN_READWRITE);
//$db->exec("INSERT INTO admin (id, name, key) VALUES (1, 'test', 'test')");
//$result = $db->query('SELECT * FROM admin');
//var_dump($result->fetchArray());




?>
