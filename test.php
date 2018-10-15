<?php

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

$result = $db->query("SELECT * FROM product WHERE CAST(strftime('%s', product.date)  AS  integer) >= CAST(strftime('%s', '2018-01-01')  AS  integer) ");//excute sql

while($book = $result->fetchArray()){
  echo "<p>".$book['date']."</p>";
}


$db->close();//close connection of database

?>
