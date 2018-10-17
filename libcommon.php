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
  $db = new SQLite3('./assets/db/db.sq3', SQLITE3_OPEN_READWRITE);
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
    $result = $db->query("SELECT user.id FROM user WHERE user.email == '$email'");//sql
    while($user = $result->fetchArray()){
      $userid = $user[0];
    }
    $db->close();//close db
  }
  return $userid;
}

// Get Next ID in table of datebase
function getNextID($str){
  $id = "";//empty string for initial return value
  $db = loadDB(); //load database
  $result = $db->query("SELECT MAX(id) FROM $str ;");//sql
  while($table = $result->fetchArray()){
    $id = $table[0];
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
  $isOk = FALSE;//0 for initial return value
  $db = loadDB(); //load database
  if ($db->exec("INSERT INTO user (id, email, key, name) VALUES ($id, '$email', '$key', '$name');") ){//insert user
    $isOK = TRUE;//succeed
  }
  $db->close();//close db
  return $isOK;
}

// Update User
function updateUser($id, $email, $key, $name){
  $isOk = FALSE;//0 for initial return value
  $db = loadDB(); //load database
  if ($db->exec("UPDATE user SET email='$email', key='$key', name='$name' WHERE id=$id ;") ){//update user
    $isOK = TRUE;//succeed
  }
  $db->close();//close db
  return $isOK;
}

// Delete Order
function deleteOrder($id){
  $isOk = FALSE;//0 for initial return value
  $db = loadDB(); //load database
  if ($db->exec("DELETE FROM orders WHERE id=$id ;") ){//delete order in table orders
    if ($db->exec("DELETE FROM orderproducts WHERE orderid=$id ;") ){//delete products in that order
      $isOK = TRUE;//succeed
    }
  }
  $db->close();//close db
  return $isOK;
}
?>
