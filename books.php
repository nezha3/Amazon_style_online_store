<?php

/************************************************
File:		  books.php
Author:		Oliver Chi
Purpose:	display books in categories or others
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

/*
 * Display Books in One Category
 */
if (array_key_exists('category', $_GET)) {//books in one category
    $num = intval($_GET['category']);
    $result = $db->query("SELECT product.id, product.title FROM product WHERE product.category == ".$num);//sql
    echo "<h3>".$category[$num].":</h3>";
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
/*
 * Display One Book with Comments
 */
} elseif (array_key_exists('id', $_GET)){//book in product.id
    $id = intval($_GET['id']);
    $result = $db->query("SELECT * FROM product WHERE product.id == ".$id);//sql
    $book = $result->fetchArray();
    echo "<div id='rightCol'>";//right column
      echo "<p class='price'>$".$book['price']."</p>";
      echo "<b>In stock.</b>
            <p>Ships from and sold by AmazonBear AU. Gift-wrap available.</p>";
      //form; TODO:add book to cart
      echo "<form method='GET' action='./cart.php'>
              <b>Quantity</b>
              <select name='quantity'>";
      for ($i=1; $i<=100; $i++){
        echo "<option value='".$i."'>".$i."</option>";
      }
      echo   "</select>
              <input type='submit' value='Add to Cart'>
              <input type='text' name='id' value='$id' style='display: none;'>
            </form>";
    echo "</div>";
    echo "<div id='leftCol'>";//left column
      echo "<img src='assets/media/img/books/".$id.".jpg' alt='Image'>";
    echo "</div>";
    echo "<div id='centerCol'>";//middle column
      echo "<div class='title'><h2>".$book['title']."</h2><p>".$book['author']."</p><p>".$book['date']."</p></div>";
      echo "<div class='brief'><p>".$book['brief']."</p></div>";
      echo "<div class='description'><p>".$book['description']."</p></div>";
      echo "<div id='review'><img src='assets/media/img/open.png' alt='show comments' onclick='comments($id)'><b onclick='comments($id)'>&nbsp;&nbsp;Customer reviews:</b><div id='comments' class='comments'></div></div>";
    echo "</div>";
/*
 * Display Books by Type in category/bestseller/newrelease
 */
} else {
  pageCookie('home');//set page cookie
  $row = strval($_GET['row']);
  if ($row == "category"){
    echo "<h3>By Categories:</h3>";
    echo "<div class='bookrow'>";
      for ($i=0; $i<count($category);$i++){
        echo "<div class='book'>";
        echo "<a href='#' onclick='category(".$i.")'>";
        echo "<img src='assets/media/img/category/".$i.".jpg' alt='Image'>";
        echo "<p>$category[$i]</p>";
        echo "</a>";
        echo "</div>";
      }
    echo "</div>";
  } elseif ($row == "bestseller"){

  } elseif ($row == "newrelease") {

  } else {

  }
}

$db->close();//close connection of database

 ?>
