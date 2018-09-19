<?php

/************************************************
File:		  books.php
Author:		Oliver Chi
Purpose:	display books in categories or others
**************************************************/

require("libcommon.php");//add common interfaces

/* Get book/books */
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
} elseif (array_key_exists('id', $_GET)){//book in product.id
    $id = intval($_GET['id']);
    $result = $db->query("SELECT * FROM product WHERE product.id == ".$id);//sql
    $book = $result->fetchArray();
    echo "<div id='rightCol'>";//right column
      echo "<div class='price'><p>$".$book['price']."</p></div>";
    echo "</div>";
    echo "<div id='leftCol'>";//left column
      echo "<img src='assets/media/img/books/".$id.".jpg' alt='Image'>";
    echo "</div>";
    echo "<div id='centerCol'>";//middle column
      echo "<div class='title'><h2>".$book['title']."</h2><p>".$book['author']."</p><p>".$book['date']."</p></div>";
      echo "<div class='brief'><p>".$book['brief']."</p></div>";
      echo "<div class='description'><p>".$book['description']."</p></div>";
    echo "</div>";
} else {
  $row = strval($_GET['row']);
  if ($row == "category"){

  } elseif ($row == "bestseller"){

  } elseif ($row == "newrelease") {

  } else {

  }
}


 ?>
