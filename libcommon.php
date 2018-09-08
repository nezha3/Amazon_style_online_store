<?php

/************************************************
File:		  libcommon.php
Author:		Oliver Chi
Purpose:	Load database and check the tables
**************************************************/
$db = new SQLite3('./assets/db/db.sq3', SQLITE3_OPEN_READWRITE);

$db->exec("INSERT INTO admin (id, name, key) VALUES (1, 'test', 'test')");

$result = $db->query('SELECT * FROM admin');
var_dump($result->fetchArray());

?>
