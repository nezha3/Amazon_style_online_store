<?php

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

echo date("Y-m-d");

$db->close();//close connection of database

?>
