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
$result = $db->query("SELECT review.id, review.userid, review.star, review.comment FROM review WHERE review.productid == ".$book_id);//sql
// Print out every comment
while($comment = $result->fetchArray()){
  echo "<div class='comment'>";
    echo "<img src='assets/media/img/person.png' alt='Image'>";
    echo "<span>".$comment['userid']."</span>";
    echo "<span id='errorMsg'></span>";
    echo "<p>".$comment['star']."</p>";
    echo "<p>".$comment['id']."</p>";
    echo "<p>".$comment['comment']."</p>";
    echo "<input type='button' value='delete'>";
  echo "</div>";
}
echo "<input type='button' value='add'>";

$db->close();//close connection of database

?>