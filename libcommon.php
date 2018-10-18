<?php

/************************************************
File:		  libcommon.php
Author:		Oliver Chi
Purpose:	Load database and check cookies
**************************************************/

// Define globaL variables
$dir = dirname(__FILE__);
$category = array("Children's Books","Textbooks & Study Guides","Science Fiction & Fantasy","Literature & Fiction","Travel & Tourism","Romance","Business & Economics","Mystery, Thriller & Suspense","Biographies & Memoirs","Health, Fitness & Nutrition","Cookbooks, Food & Wine","Teen & Young Adult");

// Load Database
function loadDB(){
  try{ $db = new SQLite3('./assets/db/db.sq3', SQLITE3_OPEN_READWRITE); } catch(Exception $exception){ echo $exception->getMessage(); }
  return $db;
}

// Go homepage
function goHome(){
  header("Refresh:0; url=index.php");
  //header('Location: index.php');
}


// Go back previous page
function goBack(){
  if(isset($_REQUEST["destination"])){
      header("Location: {$_REQUEST["destination"]}");
  }else if(isset($_SERVER["HTTP_REFERER"])){
      header("Location: {$_SERVER["HTTP_REFERER"]}");
  }else{
      header('Location: index.php');/* some fallback, maybe redirect to index.php */
  }
  exit();
}

// Establsih page cookie when not existed or change page location
function pageCookie($p){
  if (isset($_COOKIE)){
    setcookie("page", $p, time() + (900), "/");//set page cookie timeout of 15 mins
  } else {
    echo "This website uses COOKIE, please enable COOKIE in your explorer.";
  }
}

// Establsih/Set Error Messgae Cookie
function errorCookie($msg){
  if (isset($_COOKIE)){
    setcookie("error", $msg, time() + (30), "/");//set page cookie timeout of 30 seconds
  } else {
    echo "This website uses COOKIE, please enable COOKIE in your explorer.";
  }
}

// Get Error Cookie
function getError(){
  if (isset($_COOKIE["error"])) {
    return $_COOKIE["registeruser"];
  }
  return "";//if fail, return empty string
}

// Get register user email
function getEmail(){
  if (isset($_COOKIE["registeruser"])) {
    return $_COOKIE["registeruser"];
  }
  return "";//if fail, return empty string
}

// Establish name cookie when not existed
function nameCookie($e){
  if (isset($_COOKIE)){
    setcookie("name", $e, time() + (9000), "/");//set name cookie timeout of 150 mins
  } else {
    echo "This website uses COOKIE, please enable COOKIE in your explorer.";
  }
}

// Establish user cookie when not existed
function userCookie($e){
  if (isset($_COOKIE)){
    setcookie("registeruser", $e, time() + (9000), "/");//set user cookie timeout of 150 mins
  } else {
    echo "This website uses COOKIE, please enable COOKIE in your explorer.";
  }
}

// Check if already logining
function loginCheck(){
  if (isset($_COOKIE["registeruser"])) {
    return 1;//true
  }
  return 0;//false
}

// Get User
function getUserID(){
  $userid = "";//empty string for initial return value
  if (isset($_COOKIE["registeruser"])) {
    $db = loadDB(); //load database
    $email = $_COOKIE["registeruser"];

    //avoid sql injection attack
    //escape key words in Sqlite3
    $email=SQLite3::escapeString($email);

    $result = $db->query("SELECT user.id FROM user WHERE user.email == '$email'");//sql
    while($user = $result->fetchArray()){
      $userid = $user[0];
    }
    $db->close();//close db
  }
  return $userid;
}

// Get Next ID in table of datebase
// if fail, return ""
// if succeed, return next id
function getNextID($str){
  $id = "";//empty string for initial return value
  $db = loadDB(); //load database
  $result = $db->query("SELECT MAX(id) FROM $str ;");//sql
  while($table = $result->fetchArray()){
    $id = intval($table[0]) + 1;
  }
  $db->close();//close db
  return $id;
}

// Get page location
function getPage(){
  if (isset($_COOKIE["page"])) {
    return $_COOKIE["page"];
  }
  return "";//if fail, return empty string
}

// Set cart cookie
function cartCookie($c){
  if (isset($_COOKIE)){
    setcookie("cart", json_encode($c), time() + (86400 * 1), "/");//set out time of cart cookie as 1 day
  } else {
    echo "This website uses COOKIE, please enable COOKIE in your explorer.";
  }
}

// Check if empty in cart
function cartCheck(){
  if (isset($_COOKIE["cart"])) {
    return 1;//true
  }
  return 0;//false
}

// Get array values of cart info
function getCart(){
  if (isset($_COOKIE["cart"])) {
    return json_decode($_COOKIE["cart"], true);
  }
  return "";//if fail, return empty string
}

// Insert User
function insertUser($id, $email, $key, $name){
  $isOK = FALSE;//0 for initial return value
  $db = loadDB(); //load database

  //avoid sql injection attack
  //escape key words in Sqlite3
  $id=SQLite3::escapeString($id);
  $email=SQLite3::escapeString($email);
  $key=SQLite3::escapeString($key);
  $name=SQLite3::escapeString($name);

  if ($db->exec("INSERT INTO user (id, email, key, name) VALUES ($id, '$email', '$key', '$name');") ){//insert user
    $isOK = TRUE;//succeed
  }
  $db->close();//close db
  return $isOK;
}

// Update User
function updateUser($id, $email, $key, $name){
  $isOK = FALSE;//0 for initial return value
  $db = loadDB(); //load database

  //avoid sql injection attack
  //escape key words in Sqlite3
  $id=SQLite3::escapeString($id);
  $email=SQLite3::escapeString($email);
  $key=SQLite3::escapeString($key);
  $name=SQLite3::escapeString($name);

  if ($db->exec("UPDATE user SET email='$email', key='$key', name='$name' WHERE id=$id ;") ){//update user
    $isOK = TRUE;//succeed
  }
  $db->close();//close db
  return $isOK;
}

// Delete Order
function deleteOrder($id){
  $isOK = FALSE;//0 for initial return value
  $db = loadDB(); //load database
  if ($db->exec("DELETE FROM orders WHERE id=$id ;") ){//delete order in table orders
    if ($db->exec("DELETE FROM orderproducts WHERE orderid=$id ;") ){//delete products in that order
      $isOK = TRUE;//succeed
    }
  }
  $db->close();//close db
  return $isOK;
}

// Delete Comment
function deleteComment($id){
  $isOK = FALSE;//0 for initial return value
  $db = loadDB(); //load database
  if ($db->exec("DELETE FROM review WHERE id=$id ;") ){//delete comment
    $isOK = TRUE;//succeed
  }
  $db->close();//close db
  return $isOK;
}

// Insert Comment
function insertComment($id, $userid, $productid, $star, $comment){
  $isOK = FALSE;//0 for initial return value
  $db = loadDB(); //load database

  //avoid sql injection attack
  //escape key words in Sqlite3
  $comment=SQLite3::escapeString($comment);

  if ($db->exec("INSERT INTO review (id, userid, productid, star, comment) VALUES ($id, $userid, $productid, $star, '$comment');") ){//insert comment
    $isOK = TRUE;//succeed
  }
  $db->close();//close db
  return $isOK;
}

// Insert Order
function insertOrder($id, $userid, $date, $totalprice, $ifpaid, $deliveryid){
  $isOK = FALSE;//0 for initial return value
  $db = loadDB(); //load database
  if ($db->exec("INSERT INTO orders (id, userid, date, totalprice, ifpaid, deliveryid) VALUES ($id, $userid, '$date', $totalprice, $ifpaid, $deliveryid);") ){//insert order
    $isOK = TRUE;//succeed
  }
  $db->close();//close db
  return $isOK;
}

// Update totalprice in orders
function updateTotalprice($id, $totalprice){
  $isOK = FALSE;//0 for initial return value
  $db = loadDB(); //load database
  if ($db->exec("UPDATE orders SET totalprice=$totalprice WHERE id=$id ;") ){//update totalprice
    $isOK = TRUE;//succeed
  }
  $db->close();//close db
  return $isOK;
}

// Insert Product into orderproducts table
function insertOrderProducts($id, $orderid, $productid, $price, $discount, $amount){
  $isOK = FALSE;//0 for initial return value
  $db = loadDB(); //load database
  if ($db->exec("INSERT INTO orderproducts(id, orderid, productid, price, discount, amount) VALUES ($id, $orderid, $productid, $price, $discount, $amount) ;") ){//do insert
    $isOK = TRUE;//succeed
  }
  $db->close();//close db
  return $isOK;
}

?>
