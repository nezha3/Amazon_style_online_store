<?php

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

$title = strval($_GET['title']);
$star = intval($_GET['star']);
$comment = strval($_GET['comment']);
$productid = "";

$result = $db->query("SELECT product.id FROM product WHERE product.title = '$title';");//sql
while($product = $result->fetchArray()){//get product id
  $productid = $product[0];
}
if ($productid == "") {//no product id due to incorrect title
  echo "No Book Found: Book Title Incorrect!";
} else {//insert new comment into review table
  $id = getNextID("review");//get review next available id
  $userid = getUserID();//get user id
  if (insertComment($id, $userid, $productid, $star, $comment)){//do insert
    echo "Insert Comment Successfully!";
  }
}

$db->close();//close connection of database

?>
