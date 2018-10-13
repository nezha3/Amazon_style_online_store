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


 // General user
} else {//display error message

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
    while ($comment['star'])
    echo "<p>".$comment['star']."</p>";
    echo "<p>".$comment['id']."</p>";
    echo "<p>".$comment['comment']."</p>";
    echo "<input type='button' value='delete'>";
  echo "</div>";
}
echo "<input type='button' value='add'>";
echo "<p id='errorMsg'></p>";

$db->close();//close connection of database

?>
