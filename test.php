<?php

require("libcommon.php");//add common interfaces
$db = loadDB(); //load database

$title = strval($_GET['title']);
$star = intval($_GET['star']);
$comment = strval($_GET['comment']);
$productid = "";

$result = $db->query("SELECT product.id FROM product WHERE product.title = '$title';");//sql
while($product = $result->fetchArray()){//get product id
  $productid = $product[0];
}
if ($productid == "") {//no product id due to incorrect title
  echo "No Book Found: Book Title Incorrect!";
} else {//insert new comment into review table
  $id = getNextID("review");//get review next available id
  $userid = getUserID();//get user id
  if (insertComment($id, $userid, $productid, $star, $comment)){//do insert
    echo "Insert Comment Successfully!";
  }
}

$db->close();//close connection of database

?>
// JQuery AJAX FORM ACTION
$(function() {
        $("#register").click(function() {
          // validate and process form
          $('.error_msg').empty();//empty error message
          var email = $('#email').val();
          var key = $('#password').val();
          var key2 = $('#confirm').val();
          var name = $('#name').val();
          if (key != key2) $('.error_msg').text('Please Confirm Your Password Again: not equal!');
          if (!(matchExpression(email).email)) $('.error_msg').text('Incorret Email Format!');
          if (!(matchExpression(key).onlyMixOfAlphaNumeric)) $('.error_msg').text('Incorret Password Format: Password Only Contains Letters and Numbers!');
          if (!(matchExpression(name).onlyLetters)) $('.error_msg').text('Incorret Name Format: Name Only Contains Letters!');
          if ($('.error_msg').text().length == 0){//no error
            register(email, key, name);//submit register request
          }
        });
});
