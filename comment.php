<?php

/************************************************
File:		  comment.php
Author:		Oliver Chi
Purpose:	generate comments;
          for registered user: add/delete comments
**************************************************/

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

/*
 * Delete/add comments
 */
 // Registered user
 if (loginCheck()){//TODO
   $delete_button = "<input type='button' value='Delete Current Comment' class='delete_button'>";
   $add_button = "<input type='button' value='Add New Comment' class='add_button'>";
 // General user
} else {//display error message
   $delete_button = "";
   $add_button = "";
}


/*
 * Display comments
 */
$book_id = strval($_GET['id']);//book id
// Retrieve all comments for one book from database
$result = $db->query("SELECT review.id, review.userid, review.star, review.comment FROM review WHERE review.productid == ".$book_id);//sql: get comments
// Print out every comment
while($comment = $result->fetchArray()){
  echo "<div class='comment'>";
    echo "<img src='assets/media/img/person.png' alt='Image'>";
    $result2 = $db->query("SELECT * FROM user WHERE user.id == ".$comment['userid']);//sql: get user info
    while($user = $result2->fetchArray()){
      echo "<span>".$user['name']."</span>";
    }
    echo $delete_button;
    echo "<p>";//print stars
    $i = $comment['star'];
    while ($i){
      echo "<img src='assets/media/img/star.png' alt='*'>";//stars
      $i--;
    }
    $i = 5 - $comment['star'];
    while ($i){
      echo "<img src='assets/media/img/star2.png' alt=''>";//empty stars
      $i--;
    }
    echo "</p>";
    echo "<p>".$comment['comment']."</p>";
  echo "</div>";
}
echo $add_button;
echo "<p id='errorMsg'></p>";

$db->close();//close connection of database

?>
