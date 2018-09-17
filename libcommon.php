<?php

/************************************************
File:		  libcommon.php
Author:		Oliver Chi
Purpose:	Load database and check cookies
**************************************************/

// Define globaL variables
$dir = dirname(__FILE__);
$category = array("Children's Books","Textbooks & Study Guides","Science Fiction & Fantasy","Literature & Fiction","Travel & Tourism","Romance","Business & Economics","Mystery, Thriller & Suspense","Biographies & Memoirs","Health, Fitness & Nutrition","Cookbooks, Food & Wine","Teen & Young Adult");


// Check cookies




// Load Database
$db = new SQLite3('./assets/db/db.sq3', SQLITE3_OPEN_READWRITE);
//$db->exec("INSERT INTO admin (id, name, key) VALUES (1, 'test', 'test')");
//$result = $db->query('SELECT * FROM admin');
//var_dump($result->fetchArray());




?>
