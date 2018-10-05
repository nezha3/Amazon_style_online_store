<?php

/************************************************
File:		  search.php
Author:		Oliver Chi
Purpose:	do simple and complex searches
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database
pageCookie('search');//set page cookie

//print out header and footer;
//clear contents
require("layout.php");
echo $header;
echo "<div id='content'><!-- content -->
        <div class='card'><!-- search form -->
          <form class='center'>
            <div class='row'><!-- label row -->
              <div class='col-20'>
                <label>Compulsory Search Area</label>
              </div>
              <div class='col-20'>
                <label>Search Content</label>
              </div>
              <div class='col-20'>
                <label>AND/OR</label>
              </div>
              <div class='col-20'>
                <label>Option Search Area</label>
              </div>
              <div class='col-20'>
                <label>Search Content</label>
              </div>
            </div>
            <div class='row'><!-- inputs -->
              <div class='col-20'>
                <select id='field1' name='field1'>
                  <option value=''>Search Entity Area</option>
                  <option value='title'>Book Title</option>
                  <option value='author'>Author</option>
                  <option value='date'>Publish Date</option>
                  <option value='category'>Category</option>
                  <option value='keyword'>Keyword</option>
                  <option value='price'>Price</option>
                </select>
              </div>
              <div class='col-20'>
                <input type='text' name='text1' placeholder='text/keywords'>
              </div>
              <div class='col-20'>
                <select name='field2'>
                  <option value='AND'>AND</option>
                  <option value='OR'>OR</option>
                </select>
              </div>
              <div class='col-20'>
                <select id='field3' name='field3'>
                  <option value=''>Search Entity Area</option>
                  <option value='title'>Book Title</option>
                  <option value='author'>Author</option>
                  <option value='date'>Publish Date</option>
                  <option value='category'>Category</option>
                  <option value='keyword'>Keyword</option>
                  <option value='price'>Price</option>
                </select>
              </div>
              <div class='col-20'>
                <input type='text' name='text3' placeholder='text/keywords'>
              </div>
            </div>
            <div class='row'><!-- search button -->
              <input type='submit' value='Search Books'>
            </div>
          </form>
        </div>
        <div class='card'><!-- search result-->";

// only for test TODO: check all elements submitted by form
/*
echo "<table>";
foreach ($_GET as $key => $value) {
      echo "<tr>";
      echo "<td>";
      echo $key;
      echo "</td>";
      echo "<td>";
      echo $value;
      echo "</td>";
      echo "</tr>";
  }
echo "</table>";
*/

/* check if complex search */
if (array_key_exists('field1', $_GET)) {//complex search
  $field1 = strval($_GET['field1']);//get field1
  if($field1==""){
    echo "<p class='error_msg'>The first search area is compulsory, please recheck your input!</p>";
  }
} else {//simple search
  if (array_key_exists('category', $_GET)) {
    $field = strval($_GET['category']);//get category
    $keyword = strval($_GET['keyword']);//get keyword
    if (strcmp($field, 'All')==0){//search in all categories
      $result = $db->query("SELECT * FROM product WHERE title LIKE '%$keyword%' ");//excute sql
      echo "<h3>Search Results:</h3>";
      echo "<div class='bookrow'>";
      while($book = $result->fetchArray()){
        echo "<div class='book'>";
        echo "<a href='#' onclick='books(".$book['id'].")'>";
        echo "<img src='assets/media/img/books/".$book['id'].".jpg' alt='Image'>";
        echo "<p>".$book['title']."</p>";
        echo "</a>";
        echo "</div>";
      }
      echo "</div><!-- end of book rows -->";
    } else {//search in one category
      $result = $db->query("SELECT * FROM product WHERE title LIKE '%$keyword%' AND category = '$field' ");//excute sql
      echo "<h3>Search Results:</h3>";
      echo "<div class='bookrow'>";
      while($book = $result->fetchArray()){
        echo "<div class='book'>";
        echo "<a href='#' onclick='books(".$book['id'].")'>";
        echo "<img src='assets/media/img/books/".$book['id'].".jpg' alt='Image'>";
        echo "<p>".$book['title']."</p>";
        echo "</a>";
        echo "</div>";
      }
      echo "</div><!-- end of book rows -->";
    }
  } else {
    echo "<p class='error_msg'>Error happened in search form, please recheck your input!</p>";
  }

}

echo "</div><!-- end of card -->
  </div><!-- end of content -->";
echo $footer;

$db->close();//close connection of database

 ?>
