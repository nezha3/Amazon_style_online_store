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
  header("Refresh:1; url=index.php");
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

// Establish user cookie when not existed
function userCookie($e){
  if (isset($_COOKIE)){
    setcookie("registeruser", $e, time() + (900), "/");//set user cookie timeout of 15 mins
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

// Get register user email
function getEmail(){
  if (isset($_COOKIE["registeruser"])) {
    return $_COOKIE["registeruser"];
  }
  return "";//if fail, return empty string
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
?>
