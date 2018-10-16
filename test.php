<?php

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

echo getNextID("orders");

$db->close();//close connection of database

?>
