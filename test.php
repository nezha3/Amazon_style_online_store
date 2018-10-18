<?php

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

$date = new DateTime();
$date->modify('-3650 day');
$date1 = $date->format('Y-m-d');
echo strtotime($date1);
echo "<br>";
$date->modify('+3650 day');
$date1 = $date->format('Y-m-d');
echo strtotime($date1);


$db->close();//close connection of database

?>
