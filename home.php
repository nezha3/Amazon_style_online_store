<?php

/************************************************
File:		  home.php
Author:		Oliver Chi
Purpose:	display content in homepage
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

/* Actions */
// Display Structure For Homepage Content
if (array_key_exists('action', $_GET)) {
  // HTML structure for left column
  echo "<div id='leftcolumn'><!-- left column for Category and Refine -->
          <div class='card'><!-- new releases -->
            <h3>New Releases</h3>
            <p>&nbsp;&nbsp;<a href='#' onclick='newrelease(1)'>Last 7 Days</a></p>
            <p>&nbsp;&nbsp;<a href='#' onclick='newrelease(2)'>Last 30 Days</a></p>
            <p>&nbsp;&nbsp;<a href='#' onclick='newrelease(3)'>Last 90 Days</a></p>
          </div>
          <div class='card'><!-- discount -->
            <h3>Discount</h3>
            <p>&nbsp;&nbsp;<a href='#' onclick='discount(1)'>5% off or More</a></p>
            <p>&nbsp;&nbsp;<a href='#' onclick='discount(2)'>10% off or More</a></p>
            <p>&nbsp;&nbsp;<a href='#' onclick='discount(3)'>15% off or More</a></p>
          </div>
          <div class='card'><!-- refine by -->
            <h3>Best Sellers</h3>
            <p>&nbsp;&nbsp;<a href='#' onclick='bestsellers(1)'>Best Sellers 1</a></p>
            <p>&nbsp;&nbsp;<a href='#' onclick='bestsellers(2)'>Best Sellers 2</a></p>
            <p>&nbsp;&nbsp;<a href='#' onclick='bestsellers(3)'>Best Sellers 3</a></p>
          </div>
        </div>";

  // HTML structure for right column
  echo "<div id='rightcolumn'><!-- right column for display books -->
          <div class='card'><!-- by Category -->
          </div>
      </div>";

// Discount Books
} else if (array_key_exists('discount', $_GET)){
  $range = 1 - 0.05*intval($_GET["discount"]);
  $result = $db->query("SELECT product.id, product.title FROM product WHERE product.discount <= ".$range);//sql
  echo "<h3>Discount Books:</h3>";
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

// New Release Books
} else if (array_key_exists('newrelease', $_GET)){
  $range = intval($_GET["newrelease"]);
  $date1 = new DateTime();
  if ($range == 1){
    $date1->modify('-365 day');
  } else if ($range == 2){
    $date1->modify('-730 day');
  } else {
    $date1->modify('-1095 day');
  }
  $date = $date1->format('Y-m-d');
  $result = $db->query("SELECT product.id, product.title, product.date FROM product ;");//sql
  echo "<h3>New Release Books:</h3>";
  echo "<div class='bookrow'>";
  while($book = $result->fetchArray()){
    if (strtotime($book['date']) > strtotime($date)){//check if date is nearer
      echo "<div class='book'>";
      echo "<a href='#' onclick='books(".$book['id'].")'>";
      echo "<img src='assets/media/img/books/".$book['id'].".jpg' alt='Image'>";
      echo "<p>".$book['title']."</p>";
      echo "</a>";
      echo "</div>";
    }
  }
  echo "</div><!-- end of book rows -->";

// Best Seller Books
} else if (array_key_exists('bestseller', $_GET)){
  $range = intval($_GET["bestseller"]);
  echo "<h3>Best Sellers:</h3>";
  echo "<div class='bookrow'>";
  $count = $db->query("SELECT * FROM (SELECT productid, count(*) AS num FROM orderproducts GROUP BY productid ) AS countnum WHERE num >= $range;");//count sell times of books
  while($product = $count->fetchArray()){//get products/books
    $productid = $product['productid'];
    $result = $db->query("SELECT product.id, product.title FROM product WHERE product.id == ".$productid);//get book info
    while($book = $result->fetchArray()){
      echo "<div class='book'>";
      echo "<a href='#' onclick='books(".$book['id'].")'>";
      echo "<img src='assets/media/img/books/".$book['id'].".jpg' alt='Image'>";
      echo "<p>".$book['title']."</p>";
      echo "</a>";
      echo "</div>";
    }
  }
  echo "</div><!-- end of book rows -->";
}

$db->close();
?>
