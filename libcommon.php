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

// Establish user cookie when not existed
function userCookie($email){
  if (count($_COOKIE) > 0){
    setcookie("registeruser", $email, time() + (86400 * 30), "/");
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

// Set cart cookie
function cartCookie($cartValue){
  if (count($_COOKIE) > 0){
    setcookie("cart", json_encode($cartValue), time() + (86400 * 30), "/");
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
