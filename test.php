<?php

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

echo getUserID();

$db->close();//close connection of database

?>
